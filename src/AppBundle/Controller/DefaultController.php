<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Mailer;

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
    public function contactAction(Request $request, Mailer $mailer, ContactType $contact)
    {

        isset($_GET['type']) ? $contact->setType($_GET['type']) : $contact->setType('Default');

        $form = $this->createForm(ContactType::class,
            $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && false !== $mailer->send($contact)) {
            $session = $request->getSession();
            $session->getFlashBag()->add('success',
                'Votre demande a bien été prise en compte. Une réponse vous sera apportée dans les meilleurs délais.');

            return new RedirectResponse($this->get('router')->generate('homepage'));
        }

        return $this->render("AppBundle:default:contact.html.twig",
            array(
                'form' => $form->createView(),
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

    /**
     * @Route("/ressources", name="ressources")
     */
    public function ressourcesAction(Request $request)
    {
        return $this->render("AppBundle:default:ressources.html.twig");
    }
}
