<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 02/10/2018
 * Time: 16:01
 */

namespace AppBundle\Validator;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\FormError;

/**
 * Captcha validator
 *
 * @author vmary <vmary.fr@gmail.com>
 */
class GoogleCaptchaValidator
{
    private $secretKey;

    private $requestStack;

    public function __construct(String $secretKey, RequestStack $requestStack)
    {
        $this->secretKey = $secretKey;
        $this->requestStack = $requestStack;
    }

    /**
     * @param FormEvent $event
     *
     * @throws \Exception If Guzzle Client can't be instantiated
     *
     * @return boolean If form is valid
     */
    public function validate(FormEvent $event)
    {
        $form = $event->getForm();
        if (empty($_POST['g-recaptcha-response'])) {
            $form->addError(new FormError('Veuillez valider le captcha Google'));
            return false;
        }

        $request = $this->requestStack->getCurrentRequest();

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'response' => $_POST['g-recaptcha-response'],
                'secret' => $this->secretKey,
                'remoteip' => $request->getClientIp()
            ]
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        return (bool)$content['success'];
    }
}