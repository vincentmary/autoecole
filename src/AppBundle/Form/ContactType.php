<?php
// src/AppBundle/Form/ContactType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
  protected $name;

  protected $mail;

  protected $type;

  protected $message;

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, array(
          'required' => TRUE,
          'label' => 'Nom'
        ))
      ->add('mail', EmailType::class, array(
          'required' => TRUE,
        ))
      ->add('message', TextAreaType::class, array(
          'required' => TRUE
        ))
      ->add('save', SubmitType::class, array('label' => 'Envoyer'))
      ->getForm();
  }

  /**
   * @param string $message
   */
  public function setMessage($message) {
    $this->message = $message;
  }

  /**
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * @param string $type
   */
  public function setType($type) {
    $this->type = $type;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $mail
   */
  public function setMail($mail) {
    $this->mail = $mail;
  }

  /**
   * @return string
   */
  public function getMail() {
    return $this->mail;
  }

  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }
}