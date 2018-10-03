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
     * @var String The sender mail
     */
    private $mailerSender;

    /**
     * @var String Delivery Address
     */
    private $mailerDeliveryAddress;

    private $mailer;

    public function __construct($mailerSender, $mailerDeliveryAddress, \Swift_Mailer $mailer)
    {
        $this->mailerSender = $mailerSender;
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
            ->setFrom($this->mailerSender)
            ->setTo($contact->getMail())
            ->setBody($body, 'text/html');
//
//        $headers = "From: " . $this->mailerSender . " \r\n".
//            "Reply-To: " . $contact->getMail() . "\r\n".
//            "MIME-Version: 1.0" . "\r\n" .
//            "Content-type: text/html; charset=UTF-8" . "\r\n".
//            "X-Mailer: PHP/" . phpversion();
//
//        return mail($this->mailerDeliveryAddress, $subject, $contact->getMessage(), $headers);

        $this->mailer->send($message);
    }

}