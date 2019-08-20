<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 02/10/2018
 * Time: 14:37
 */

namespace AppBundle\Service;


use AppBundle\Form\ContactType;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var String Delivery Address
     */
    private $mailerDeliveryAddress;


    public function __construct($mailerDeliveryAddress, \Swift_Mailer $mailer)
    {
        $this->mailerDeliveryAddress = $mailerDeliveryAddress;
        $this->mailer = $mailer;
    }

    public function send(ContactType $contact)
    {
        $subject = NULL;
        if (! is_null($contact->getType())) {
            $subject = '[' . $contact->getType() . '] ';
        }
        $subject .= 'Message de ' . $contact->getName() . ' ' . $contact->getMail();

        //add phone if set in message
        $body = $contact->getTel() ? ' Téléphone ' . $contact->getTel() . '<br/><br/>' : '';
        $body .= $contact->getMessage();

        $contact->setMessage($body);

        $message = (new \Swift_Message($subject))
            ->setFrom([
                $contact->getMail() => $contact->getMail()
            ])
            ->setTo($this->mailerDeliveryAddress)
            ->setBody($body, 'text/html');

        return $this->mailer->send($message);
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAdress($deliveryAddress) {
        $this->mailerDeliveryAddress = $deliveryAddress;
    }

}