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
    public function send(ContactType $contact)
    {
        $subject = NULL;
        if (! is_null($contact->getType())) {
            $subject = '[' . $contact->getType() . '] ';
        }
        $subject .= 'Message de ' . $contact->getName() . ' ' . $contact->getMail();

        //add phone if set in message
        $message = $contact->getTel() ? ' Téléphone ' . $contact->getTel() . '<br/><br/>' : '';
        $message .= $contact->getMessage();
        $contact->setMessage($message);

        $headers = "From: " . getenv('MAILER_SENDER') . " \r\n".
            "Reply-To: " . $contact->getMail() . "\r\n".
            "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=UTF-8" . "\r\n".
            "X-Mailer: PHP/" . phpversion();

        return mail(getenv('MAILER_DELIVERY_ADRESS'), $subject, $contact->getMessage(), $headers);
    }

}