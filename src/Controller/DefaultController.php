<?php

namespace App\Controller;

use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BusType;
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
            'meta_content' => 'Busdiscothèque est le meilleur choix'
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
     * @Route("/bus/mini", name="bus_mini")
     * @return Response
     */
    public function bus_mini(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_mini.html.twig', [
            'current_page' => 'bus_mini',
        ]);
    }
    /**
     * @Route("/bus/classic", name="bus_simple")
     * @return Response
     */
    public function bus_simple(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_simple.html.twig', [
            'current_page' => 'bus_simple',
        ]);
    }
    /**
     * @Route("/bus/double", name="bus_double")
     * @return Response
     */
    public function bus_double(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_double.html.twig', [
            'current_page' => 'bus_double',
        ]);
    }
    /**
     * @Route("/bus/super_double", name="bus_super")
     * @return Response
     */
    public function bus_super(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_super.html.twig', [
            'current_page' => 'bus_super',
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
        $buses = array(
            new BusType('Mini Bus', 9, 7, 290),
            new BusType('Classic Bus', 35, 12, 890),
            new BusType('Double Bus', 55, 18, 1090),
            new BusType('Double Bus Terrasse', 55, 18, 1190),
            new BusType('Super Double Bus', 70, 18, 1190)
        );
        return $this->render('default/pricing.html.twig', [
            'current_page' => 'pricing', 'buses' => $buses
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