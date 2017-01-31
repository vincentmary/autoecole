<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:default:autoecole.html.twig');
    }

    /**
     * @Route("/autoecole", name="autoecole")
     */
    public function autoecoleAction(Request $request)
    {
        return $this->render("AppBundle:default:autoecole.html.twig");
    }

    /**
     * @Route("/permis", name="permis")
     */
    public function permisAction(Request $request)
    {
        return $this->render("AppBundle:default:permis.html.twig");
    }

    /**
     * @Route("/financement", name="financement")
     */
    public function financementAction(Request $request)
    {
        return $this->render("AppBundle:default:financement.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $contact = new ContactType();

        if (isset($_GET['type']))
        {
          $contact->setType($_GET['type']);
        }
        else
        {
          $contact->setType('Default');
        }

        $form = $this->createForm(ContactType::class, $contact);

        if ($form->handleRequest($request)->isValid())
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

          $headers = "From: " . $this->container->getParameter('mailer_sender') . " \r\n".
              "Reply-To: " . $contact->getMail() . "\r\n".
              "MIME-Version: 1.0" . "\r\n" .
              "Content-type: text/html; charset=UTF-8" . "\r\n".
              "X-Mailer: PHP/" . phpversion();

          if (mail($this->container->getParameter('mailer_delivery_adress'), $subject, $contact->getMessage(), $headers) != FALSE)
          {
            $session = $request->getSession();
            $session->getFlashBag()->add('success', 'Votre demande a bien été prise en compte. Une réponse vous sera apportée dans les meilleurs délais.');

            return new RedirectResponse($this->get('router')->generate('homepage'));
          }
        }

        return $this->render("AppBundle:default:contact.html.twig", array(
            'form' => $form->createView()
          ));
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request)
    {
        return $this->render("AppBundle:default:inscription.html.twig");
    }

  /**
   * @Route("/coordonnees", name="coordonnees")
   */
  public function coordonnesAction(Request $request)
  {
    return $this->render("AppBundle:default:coordonnees.html.twig");
  }
}
