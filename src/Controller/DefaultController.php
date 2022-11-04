<?php

namespace App\Controller;

use App\Entity\BusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    const default_options = array(
        'mini'      => array('karaoke', 'soft', 'fridge', 'screen', 'bluetooth'),
        'middle'    => array('agent', 'bluetooth', 'carpet', 'soft', 'screen', 'fridge'),
        'classic'   => array('dj', 'carpet', 'soft', 'screen', 'fridge'),
        'double'    => array('dj', 'carpet', 'soft', 'screen', 'fridge'),
        'terrasse'  => array('dj', 'carpet', 'soft', 'screen', 'fridge'),
        'super'    => array('dj', 'carpet', 'soft', 'screen', 'fridge', 'arcade', 'bubble', 'smoke')
    );

    private $bus_types;

    public function __construct(){
        $this->bus_types = array(
            'mini'      => new BusType('Mini Bus', 9, 7, 290, self::default_options['mini'], 9, 1, "(sans dj)"),
            'middle'    => new BusType('Middle Bus', 20, 10, 690, self::default_options['middle'], 20, 10, "(sans dj)"),
            'classic'   => new BusType('Classic Bus', 35, 12, 890, self::default_options['classic'], 35, 21),
            'double'    => new BusType('Double Bus', 55, 18, 1090, self::default_options['double'], 55, 36),
            'terrasse'  => new BusType('Double Bus Terrasse', 55, 18, 1190, self::default_options['terrasse'], 55, 36,),
            'super'     => new BusType('Super Double Bus', 70, 18, 1190, self::default_options['super'], 70, 36)
        );
        $this->bus_types["mini"]->addBus(   'mini bus disco',   'minibusdisco', 9,  3);
        $this->bus_types["middle"]->addBus( 'mini boss',        'miniboss',     20, 3);
        $this->bus_types["classic"]->addBus('le sodade',        'sodade',       35, 3);
        $this->bus_types["classic"]->addBus('le poowood',       'poowood',      35, 3);
        $this->bus_types["classic"]->addBus("l'ange c6",        'angec6',       35, 4);
        $this->bus_types["classic"]->addBus('le s linone',      'slinone',      35, 4);
        $this->bus_types["classic"]->addBus('le carnaval',      'carnaval',     35, 3);
        $this->bus_types["classic"]->addBus('le star-lord',     'starlord',     35, 4);
        $this->bus_types["double"]->addBus( 'le condor',        'condor',       55, 6,  'double bus terrasse');
        $this->bus_types["double"]->addBus( 'le big ben',       'bigben',       55, 6);
        $this->bus_types["double"]->addBus( 'le dark kiss',     'darkkiss',     55, 9);
        $this->bus_types["double"]->addBus( 'le seven 7',       'seven7',       55, 3);
        $this->bus_types["super"]->addBus(  'le léviator',      'leviator',     70, 8);
    }
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
        $bus_types = $this->bus_types;
        unset($bus_types['terrasse']);
        return $this->render('default/bus.html.twig', [
            'current_page' => 'bus', 'bus_types' => $bus_types
        ]);
    }
    /**
     * @Route("/bus/mini", name="bus_mini")
     * @return Response
     */
    public function bus_mini(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_mini.html.twig', [
            'current_page' => 'bus_mini', 'buses' => $this->bus_types['mini']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/middle", name="bus_middle")
     * @return Response
     */
    public function bus_middle(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_middle.html.twig', [
            'current_page' => 'bus_middle', 'buses' => $this->bus_types['middle']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/classic", name="bus_classic")
     * @return Response
     */
    public function bus_classic(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_classic.html.twig', [
            'current_page' => 'bus_classic', 'buses' => $this->bus_types['classic']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/double", name="bus_double")
     * @return Response
     */
    public function bus_double(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_double.html.twig', [
            'current_page' => 'bus_double', 'buses' => $this->bus_types['double']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/super_double", name="bus_super")
     * @return Response
     */
    public function bus_super(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_super.html.twig', [
            'current_page' => 'bus_super', 'buses' => $this->bus_types['super']->getBuses()
        ]);
    }
    /**
     * @Route("/soirée", name="program")
     * @return Response
     */
    public function program(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/program.html.twig', [
            'current_page' => 'program',
        ]);
    }
    /**
     * @Route("/prix", name="pricing")
     * @return Response
     */
    public function pricing(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/pricing.html.twig', [
            'current_page' => 'pricing', 'bus_types' => $this->bus_types
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
     * @Route("/réservation", name="booking")
     * @return Response
     */
    public function booking(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/booking.html.twig', [
            'current_page' => 'booking',
        ]);
    }
    /**
     * @Route("/mentions_légales", name="legal")
     * @return Response
     */
    public function legal(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/legal.html.twig', [
            'current_page' => 'legal',
        ]);
    }
    /**
     * @Route("/cgv", name="cgv")
     * @return Response
     */
    public function cgv(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/cgv.html.twig', [
            'current_page' => 'cgv',
        ]);
    }

    /**
     * @Route("/stripe/{amount}", name="stripe")
     * @param int $amount
     * @return Response
     */
    public function stripe(int $amount): \Symfony\Component\HttpFoundation\Response
    {
        if (isset($_ENV['STRIPE_TEST'])){
            if ($_ENV['STRIPE_TEST'] = 'true'){
                $pk = $_ENV['STRIPE_PK_TEST'];
                $sk = $_ENV['STRIPE_SK_TEST'];
            } else {
                $pk = $_ENV['STRIPE_PK'];
                $sk = $_ENV['STRIPE_SK'];
            }
        } else {
            return $this->redirectToRoute('index');
        }
        $amount = str_replace(',','.',$amount);
        $vars_post = array(
            'amount'		=> 	$amount,
            'description'	=> 	'BusDiscotheque by MyCarEvents',
            'payment_method_types[]' => 'card',
        );
        $fields = 'currency=eur';
        foreach($vars_post as $var_key=>$var_posted) { $fields .= '&'.$var_key.'='.urlencode($var_posted); }

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$sk
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/payment_intents");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        //curl_setopt($ch, CURLOPT_USERPWD, $sk);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $info = curl_getinfo($ch);
        $output = curl_exec($ch);
        curl_close($ch);

        $intent = json_decode($output);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $this->render('default/stripe.html.twig', [
                'key' => $pk,
                'intent' => $intent,
                'amount' => $amount,
                'current_page' => 'stripe',
            ]);
        } else {
            return $this->redirectToRoute('index');
        }
    }

    /**
     * @Route("/stripe", name="stripe_get")
     * @param Request $request
     * @return Response
     */
    public function stripe_get(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $amount = $request->query->get('amount');
        if (!(isset($amount) && is_numeric($amount))){
            $amount = 0;
        }
        return $this->stripe($amount);
    }
}