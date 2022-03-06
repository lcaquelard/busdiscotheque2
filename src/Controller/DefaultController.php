<?php

namespace App\Controller;

use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/index.html.twig', [
            'current_page' => 'index',
        ]);
    }
    /**
     * @Route("/bus", name="bus")
     * @return Response
     */
    public function bus(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus.html.twig', [
            'current_page' => 'bus',
        ]);
    }
    /**
     * @Route("/bus_mini", name="bus_mini")
     * @return Response
     */
    public function bus_mini(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_mini.html.twig', [
            'current_page' => 'bus_mini',
        ]);
    }
    /**
     * @Route("/bus_simple", name="bus_simple")
     * @return Response
     */
    public function bus_simple(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_simple.html.twig', [
            'current_page' => 'bus_simple',
        ]);
    }
    /**
     * @Route("/bus_double", name="bus_double")
     * @return Response
     */
    public function bus_double(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_double.html.twig', [
            'current_page' => 'bus_double',
        ]);
    }
    /**
     * @Route("/program", name="program")
     * @return Response
     */
    public function program(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/program.html.twig', [
            'current_page' => 'program',
        ]);
    }
    /**
     * @Route("/pricing", name="pricing")
     * @return Response
     */
    public function pricing(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/pricing.html.twig', [
            'current_page' => 'pricing',
        ]);
    }
    /**
     * @Route("/options", name="options")
     * @return Response
     */
    public function options(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/options.html.twig', [
            'current_page' => 'options',
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function contact(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/contact.html.twig', [
            'current_page' => 'contact',
        ]);
    }
}