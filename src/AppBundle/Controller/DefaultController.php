<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
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
        return $this->render("AppBundle:default:contact.html.twig");
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request)
    {
        return $this->render("AppBundle:default:inscription.html.twig");
    }
}
