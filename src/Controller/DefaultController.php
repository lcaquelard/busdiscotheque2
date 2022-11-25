<?php

namespace App\Controller;

use App\Entity\BusType;
use App\Entity\OptionGroup;
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
    private $option_groups = Array();

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


        $this->option_groups['christmas'] = new OptionGroup('christmas', 'Nos offres de Noël', false);
        $this->option_groups['christmas']->addOption('christmas_hat', 'Chapeaux de Noël', 'À partir de 100€', 'Ils ont été sages cette année, soyez le Père Noël de vos convives et offrez leur ces jolis chapeaux, avant de monter à bord de votre traineau<br>Bus Discothèque !<br><br><span class="bold">Pack(35): 100€ - Pack(55): 150€ - Pack(70): 200€</span>');
        $this->option_groups['christmas']->addOption('christmas_headclip', 'Serre-tête de Noël', 'À partir de 150€', 'QU\'EST-CE QUE SERAIT NOËL SANS LES CERFS POUR<br>TIRER LE TRAINEAU ?<br> EQUIPEZ VOS INVITÉS AVEC CET ACCESSOIRE ORIGINAL QUI SAURA RAVIR PETITS ET GRANDS.<br><br><span class="bold">Pack(35): 80€ - Pack(55): 120€ - Pack(70): 160€</span>');
        $this->option_groups['christmas']->addOption('christmas_pack', 'CHRISTMAS PACK', '200€', 'RIEN DE PLUS SACRÉE QUE LA MAGIE DE NOËL .<br>BUS DISCOTHEQUE VOUS OFFRE UNE AMBIANCE FÉÉRIQUE COMPLÈTE,<br>AVEC BALLONS, BOULES ET GUIRLANDES.<br>IL NE MANQUERA LES CADEAUX ET QUELQUES CHANTS DE NOËL POUR PASSER UNE NUIT EN ENFANCE !');

        $this->option_groups['default'] = new OptionGroup('default', 'Nos offres habituelles', true);
        $this->option_groups['default']->addOption('birthday_kid', 'pack anniversaire enfant', '150€', '1 BOX À BONBON, 3 BOUTEILLES DE CHAMPOMY ET UN <br><br> BUS REMPLI DE BALLONS POUR LE PLUS GRAND <br><br> BONHEUR DE VOS ENFANTS !');
        $this->option_groups['default']->addOption('birthday_adult', 'pack anniversaire adulte', '175€', '1 BOX À BONBON, 2 BOUTEILLES DE CHAMPAGNE <br><br> NICOLAS FEUILLATE ET UN BUS REMPLI DE BALLONS <br><br> POUR AJOUTER LA TOUCHE FINALE À VOTRE SOIRÉE !');
        $this->option_groups['default']->addOption('photobooth', 'Photobooth', 'À partir de 350€', 'CAPTUREZ LES MOMENTS MÉMORABLES DE VOTRE SOIRÉE EN UN SEUL CLIC ET PERSONNALISEZ VOS CLICHÉS AVEC NOTRE PHOTOBOOTH ! EMOJIS, ARRIÈRE-PLAN SUR MESURE, FILTRES, TOUT EST BON POUR RENDRE CHAQUE PHOTO UNIQUE !<br><br><span class="bold">Pack(50): 350€ - Pack(100): 400€ - Pack(150): 450€</span>');
        $this->option_groups['default']->addOption('glasses', 'lunettes lumineuses led', '180€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables !<br><br><span class="bold">Pack (35) : 180€ - Pack (55) : 280€ - Pack (70) : 350€</span>');
        $this->option_groups['default']->addOption('sticks', 'bâtons lumineux led', '150€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables !<br><br><span class="bold">Pack (35) : 150€ - Pack (55) : 200€ - Pack (70) : 250€</span>');
        $this->option_groups['default']->addOption('bracelets', 'bracelets lumineux led', '100€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables !<br><br><span class="bold">Pack (35) : 100€ - Pack (55) : 150€ - Pack (70) : 200€</span>');
        $this->option_groups['default']->addOption('hostess', 'hôtesse', '150€', 'POUR ASSURER LA BONNE TENUE DU SERVICE TOUT AU LONG DE VOTRE SOIRÉE,<br>NOUS METTONS À VOTRE DISPOSITION L\'UNE DE NOS HÔTESSES POUR RÉPONDRE AUX BESOINS DE VOS CONVIVES, POUR VOUS GARANTIR PLUS DE SÉRENITÉ.');
        $this->option_groups['default']->addOption('camera', 'Photographe', '300€', 'TOUTES LES VRAIES STARS ONT LE DROIT<br>À LEUR PAPARAZZI.<br>TOUT AU LONG DE VOTRE SOIRÉE,<br>NOTRE PHOTOGRAPHE VOUS ACCOMPAGNE POUR CAPTURER CHAQUE INSTANT MAGIQUE<br>AVEC VOS PROCHES.<br>SOURIEZ, VOUS ÊTES FLASHÉS !');
        $this->option_groups['default']->addOption('agent', 'agent de sécurité', '200€', 'La sécurité est votre priorité ?<br>Nos agents vous proposent un filtrage renforcé à l\'entrée de votre bus et veilleront au bon déroulement de votre soirée. ');
        $this->option_groups['default']->addOption('champagne', 'Champagne', '39,90€ / bouteille', 'FAVORI DANS LES GRANDES OCCASIONS ,<br>LE CHAMPAGNE EST UN MUST HAVE DANS NOS BUS.<br>NOUS NOUS OCCUPONS DE VOUS FOURNIR TOUT AU LONG DE LA SOIRÉE GRÂCE À NOTRE CUVÉE PRESTIGE<br>NICOLAS FEUILLATE.');
        $this->option_groups['default']->addOption('wine', 'Vins', '19,90€ / bouteille', 'ROUGE, BLANC OU ROSÉ,<br>IL Y EN A POUR TOUS LES GOÛTS !<br>NOUS VOUS PROPOSONS ÉGALEMENT UNE SÉLECTION<br>DE VINS, POUR ACCOMPAGNER VOS PLATEAUX APÉRITIFS ET COMMENCER LA SOIRÉE TOUT EN DOUCEUR.');
        $this->option_groups['default']->addOption('beer', '1,90€ / bouteille', '100€', 'BREVAGE PRÉFÉRÉ DE NOS ÉTUDIANTS,<br>LA BIÈRE FAIT AUSSI TRÈS BIEN L\'AFFAIRE POUR PARTAGER UN DÉBUT DE SOIRÉE À PETIT BUDGET.<br> OUBLIEZ L\'HAPPY HOUR, CHEZ NOUS, C\'EST BIÈRE PAS CHÈRE À VOLONTÉ TOUTE LA SOIRÉE !');
        $this->option_groups['default']->addOption('necklace', 'colliers hawaïens', 'À partir de 70€', 'Soirée à thème ou simple cadeau de bienvenue pour vos convives, pour les faire voyager jusqu\'au bout du monde le temps d\'une soirée !<br><br><span class="bold">Pack (35) : 70€ - Pack (55) : 110€ - Pack (70) : 140€</span>');
        $this->option_groups['default']->addOption('insurance', 'assurance annulation', '100€', 'Un imprévu vous oblige à annuler votre prestation quelques jours avant l\'événement ? Avec l\'assurance annulation, vous êtes entièrement remboursé, sans justificatif !');
        $this->option_groups['default']->addOption('karaoke', 'animation karaoké', '10€*', 'POUR LES FANS DE CÉLINE DION ET TOUS LES AUTRES, IL EST TEMPS DE FAIRE RESSORTIR VOS TALENTS DE CHANTEUR AVEC VOS AMIS GRÂCE À NOTRE KARAOKÉ !<br>(UNIQUEMENT DISPONIBLE DANS<br>CERTAINS VÉHICULES)');
        $this->option_groups['default']->addOption('arcade', 'pack arcade', '75€', 'DÉFIER  VOS AMIS  SUR DES JEUX MYTHIQUES COMME PACKMAN OU STREETFIGHTER !<br>CHAUFFEZ VOS DOIGTS ,<br>LA PARTIE VA BIENTÔT COMMENCER...');
        $this->option_groups['default']->addOption('card', 'Carton d\'invitation digital', 'Gratuit', 'AJOUTER LA TOUCHE FINALE À VOTRE ÉVÉNEMENT.<br> NOS CARTONS D\'INVITATIONS SONT LE TICKET D\'ENTRÉE POUR UNE SOIRÉE QUI RESTERA GRAVÉE DANS<br>LES MÉMOIRES !');
        $this->option_groups['default']->addOption('storage', 'entrepôt', '50€', 'VOUS AVEZ ÉGALEMENT LA POSSIBILITÉ DE DÉPOSER ALCOOLS ET BOISSONS DIRECTEMENT À NOTRE ENTREPÔT,<br>AFIN QUE NOUS PUISSIONS PRÉPARER AU MIEUX VOTRE BUS !');
    }
    /**'
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/index.html.twig', [
            'current_page'  => 'index',
            'route'         => '',
            'meta_content'  => 'Busdiscothèque est le meilleur choix'
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
            'current_page' => 'bus',
            'route'         => '/bus',
            'bus_types' => $bus_types
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
            'route'         => '/bus/mini',
            'buses' => $this->bus_types['mini']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/middle", name="bus_middle")
     * @return Response
     */
    public function bus_middle(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_middle.html.twig', [
            'current_page' => 'bus_middle',
            'route'         => '/bus/middle',
            'buses' => $this->bus_types['middle']->getBuses()
        ]);
    }
    /**
     * @Route("/bus/classic", name="bus_classic")
     * @return Response
     */
    public function bus_classic(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/bus_classic.html.twig', [
            'current_page' => 'bus_classic',
            'route'         => '/bus/classique',
            'buses' => $this->bus_types['classic']->getBuses()
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
            'route'         => '/bus/double',
            'buses' => $this->bus_types['double']->getBuses()
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
            'route'         => '/bus/super_double',
            'buses' => $this->bus_types['super']->getBuses()
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
            'route'         => '/soirée',
        ]);
    }
    /**
     * @Route("/prix", name="pricing")
     * @return Response
     */
    public function pricing(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/pricing.html.twig', [
            'current_page' => 'pricing',
            'route'         => '/prix',
            'bus_types' => $this->bus_types
        ]);
    }
    /**
     * @Route("/options", name="options")
     * @return Response
     */
    public function options(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/options.html.twig', [
            'current_page'  => 'options',
            'route'         => '/options',
            'groups'        => $this->option_groups
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
            'route'         => '/réservation',
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
            'route'         => '/mentions_légales',
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
            'route'         => '/cgv',
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
            if ($_ENV['STRIPE_TEST'] == 'true'){
                $pk = $_ENV['STRIPE_PK_TEST'];
                $sk = $_ENV['STRIPE_SK_TEST'];
            } else {
                $pk = $_ENV['STRIPE_PK'];
                $sk = $_ENV['STRIPE_SK'];
            }
        } else {
            return $this->redirectToRoute('index',);
        }
        $amount = str_replace(',','.',$amount) * 100;
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
                'amount' => $amount / 100,
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
            $amount = 1;
        }
        return $this->redirectToRoute('stripe',array('amount' => $amount));
    }
}