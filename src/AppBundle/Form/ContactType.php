<?php
// src/AppBundle/Form/ContactType.php

namespace AppBundle\Form;

use AppBundle\Form\Type\TelType;
use http\Env\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Validator\GoogleCaptchaValidator;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactType extends AbstractType
{
    protected $name;

    protected $mail;

    protected $type = NULL;

    protected $tel;

    protected $message;

    protected $requestStack;

    protected $googleSecretKey;

    public function __construct($googleSecretKey, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->googleSecretKey = $googleSecretKey;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $validator = new GoogleCaptchaValidator($this->googleSecretKey, $this->requestStack);
        $builder->addEventListener(FormEvents::POST_SUBMIT , array($validator, 'validate'));

        $builder
            ->add('name', TextType::class, array(
                'required' => TRUE,
            ))
            ->add('mail', EmailType::class, array(
                'required' => TRUE,
            ))
            ->add('tel', TelType::class, array(
                'required' => FALSE,
            ))
            ->add('message', TextAreaType::class, array(
                'required' => TRUE
            ))
            ->add('save', SubmitType::class)
            ->getForm();
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }
}
