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
        'middle'    => array('agent', 'bluetooth', 'carpet_r', 'soft', 'screen', 'fridge'),
        'classic'   => array('dj', 'carpet_r', 'soft', 'screen', 'fridge'),
        'double'    => array('dj', 'carpet_r', 'soft', 'screen', 'fridge'),
        'terrasse'  => array('dj', 'carpet_b', 'soft', 'screen', 'fridge'),
        'super'    => array('dj', 'carpet_b', 'soft', 'screen', 'fridge', 'arcade', 'bubble', 'smoke')
    );

    private $bus_types;
    private $option_groups = Array();

    public function __construct(){
        $this->bus_types = array(
            'mini'      => new BusType('Mini Bus', 9, 7, 0, self::default_options['mini'], 9, 1, "(sans dj)", false,true, 'https://www.mini-bus-party-paris.fr'),
//            'mini'      => new BusType('Mini Bus', 9, 7, 390, self::default_options['mini'], 9, 1, "(sans dj)"),
            'middle'    => new BusType('Middle Bus', 20, 10, 790, self::default_options['middle'], 20, 10, "(sans dj)"),
            'classic'   => new BusType('Classic Bus', 35, 12, 990, self::default_options['classic'], 35, 21),
            'double'    => new BusType('Double Bus', 55, 18, 1290, self::default_options['double'], 55, 36),
            'terrasse'  => new BusType('Double Bus Terrasse', 55, 18, 1390, self::default_options['terrasse'], 55, 36, '', true, false),
            'super'     => new BusType('Super Double Bus', 70, 18, 1390, self::default_options['super'], 70, 36)
        );
//        $this->bus_types["mini"]->addBus(   'mini bus disco',   'minibusdisco', 9,  3);
        $this->bus_types["middle"]->addBus( 'mini boss',        'miniboss',     20, 3);
        $this->bus_types["classic"]->addBus('le sodade',        'sodade',       35, 3);
        $this->bus_types["classic"]->addBus('le poowood',       'poowood',      35, 3);
        $this->bus_types["classic"]->addBus('l\'ange c6',       'angec6',       35, 4);
        $this->bus_types["classic"]->addBus('le s linone',      'slinone',      35, 4);
        $this->bus_types["classic"]->addBus('le carnaval',      'carnaval',     35, 3);
        $this->bus_types["classic"]->addBus('le star-lord',     'starlord',     35, 4);
        $this->bus_types["classic"]->addBus('le jeffline',      'jeffline',     35, 6);
        $this->bus_types["double"]->addBus( 'le condor',        'condor',       55, 7,  'double bus terrasse', array('dj', 'carpet_b', 'soft', 'screen', 'fridge'));
        $this->bus_types["double"]->addBus( 'le big ben',       'bigben',       55, 6);
        $this->bus_types["double"]->addBus( 'le dark kiss',     'darkkiss',     55, 9);
        $this->bus_types["double"]->addBus( 'le seven 7',       'seven7',       55, 3);
        $this->bus_types["double"]->addBus( 'le yoshi',         'yoshi',        55, 6);
        $this->bus_types["super"]->addBus(  'le léviator',      'leviator',     70, 8, '', array('dj', 'carpet_b', 'soft', 'screen', 'fridge', 'arcade', 'bubble', 'smoke'));


        $this->option_groups['christmas'] = new OptionGroup('christmas', 'Nos offres de Noël', false);
        $this->option_groups['christmas']->addOption('christmas_hat', 'Chapeaux de Noël', 'À partir de 100€', 'Ils ont été sages cette année, soyez le Père Noël de vos convives et offrez leur ces jolis chapeaux, avant de monter à bord de votre traineau<br>Bus Discothèque&nbsp;!<br><br><span class="bold">Pack(35): 100€ - Pack(55): 150€ - Pack(70): 200€</span>');
        $this->option_groups['christmas']->addOption('christmas_headclip', 'Serre-tête de Noël', 'À partir de 90€', 'QU\'EST-CE QUE SERAIT NOËL SANS LES CERFS POUR<br>TIRER LE TRAINEAU&nbsp;?<br> EQUIPEZ VOS INVITÉS AVEC CET ACCESSOIRE ORIGINAL QUI SAURA RAVIR PETITS ET GRANDS.<br><br><span class="bold">Pack(35): 90€ - Pack(55): 120€ - Pack(70): 180€</span>');
        $this->option_groups['christmas']->addOption('christmas_pack', 'CHRISTMAS PACK', '200€', 'RIEN DE PLUS SACRÉE QUE LA MAGIE DE NOËL .<br>BUS DISCOTHEQUE VOUS OFFRE UNE AMBIANCE FÉÉRIQUE COMPLÈTE,<br>AVEC BALLONS, BOULES ET GUIRLANDES.<br>IL NE MANQUERA LES CADEAUX ET QUELQUES CHANTS DE NOËL POUR PASSER UNE NUIT EN ENFANCE&nbsp;!');

        $this->option_groups['default'] = new OptionGroup('default', '', true);
        $this->option_groups['default']->addOption('birthday_kid', 'pack anniversaire enfant', '150€', '1 BOX À BONBON, 3 BOUTEILLES DE CHAMPOMY ET UN <br><br> BUS REMPLI DE BALLONS POUR LE PLUS GRAND <br><br> BONHEUR DE VOS ENFANTS&nbsp;!');
        $this->option_groups['default']->addOption('birthday_adult', 'pack anniversaire adulte', '175€', '1 BOX À BONBON, 2 BOUTEILLES DE CHAMPAGNE <br><br> NICOLAS FEUILLATE ET UN BUS REMPLI DE BALLONS <br><br> POUR AJOUTER LA TOUCHE FINALE À VOTRE SOIRÉE&nbsp;!');
        $this->option_groups['default']->addOption('photobooth', 'Photobooth', 'À partir de 350€', 'CAPTUREZ LES MOMENTS MÉMORABLES DE VOTRE SOIRÉE EN UN SEUL CLIC ET PERSONNALISEZ VOS CLICHÉS AVEC NOTRE PHOTOBOOTH&nbsp;! EMOJIS, ARRIÈRE-PLAN SUR MESURE, FILTRES, TOUT EST BON POUR RENDRE CHAQUE PHOTO UNIQUE&nbsp;!<br><br><span class="bold">Pack(50): 350€ - Pack(100): 400€ - Pack(150): 450€</span>');
        //$this->option_groups['default']->addOption('pinata', 'piñata', '150€', 'Vous cherchez à ajouter une touche de joie et de festivités à votre événement&nbsp;?<br>Ne cherchez plus&nbsp;! Découvrez nos piñatas, le moyen idéal pour divertir vos invités et créer des souvenirs inoubliables&nbsp;!');
        $this->option_groups['default']->addOption('spinner', 'SPINNER 360', '400€', "Explorez de nouvelles dimensions avec notre photobooth 360&nbsp;! Plongez dans un monde de divertissement où vos souvenirs prennent vie et vos événements sont gravés dans l'éternité&nbsp;!");
        $this->option_groups['default']->addOption('balloons', 'ballons personnalisés', '100€', 'Apportez une explosion de couleurs à votre événement&nbsp;! Préparez-vous à transformer votre bus discotheque en un véritable paradis de couleur à votre goût&nbsp;!');
        $this->option_groups['default']->addOption('redbull', 'redbull', '2.90€', 'Prêt à faire de votre soirée bus une expérience inoubliable&nbsp;? Partagez un redbull avec vos convives, la boisson ultime pour vous donner l\'énergie nécessaire afin de danser toute la nuit&nbsp;!');
        $this->option_groups['default']->addOption('glasses', 'lunettes lumineuses led', '180€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables&nbsp;!<br><br><span class="bold">Pack (35) : 180€ - Pack (55) : 280€ - Pack (70) : 350€</span>');
        $this->option_groups['default']->addOption('sticks', 'bâtons lumineux led', '150€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables&nbsp;!<br><br><span class="bold">Pack (35) : 150€ - Pack (55) : 200€ - Pack (70) : 250€</span>');
        $this->option_groups['default']->addOption('bracelets', 'bracelets lumineux led', '100€', 'Illuminez la nuit parisienne avec des accessoires lumineux et capturez des moments inoubliables&nbsp;!<br><br><span class="bold">Pack (35) : 100€ - Pack (55) : 150€ - Pack (70) : 200€</span>');
        $this->option_groups['default']->addOption('hostess', 'hôtesse', '150€', 'POUR ASSURER LA BONNE TENUE DU SERVICE TOUT AU LONG DE VOTRE SOIRÉE,<br>NOUS METTONS À VOTRE DISPOSITION L\'UNE DE NOS HÔTESSES POUR RÉPONDRE AUX BESOINS DE VOS CONVIVES, POUR VOUS GARANTIR PLUS DE SÉRENITÉ.');
        $this->option_groups['default']->addOption('balloons_age', 'Votre age en ballon', '50€', 'PERSONNALISEZ VOTRE ÉVÉNEMENT JUSQU\'AU DERNIER DÉTAIL !<br><br>DE VOS 10 ANS À  VOS 100 ANS ANS,&nbsp;AJOUTEZ VOTRE AGE AVEC DEUX BALLONS CHIFFRÉS&nbsp;!');
        $this->option_groups['default']->addOption('coin_pusher', 'coin pusher machine à sous', '150€', 'DES JEUX DE FÊTE FORAINE À BORD D\'UN BUS DISCOTHEQUE, ÇA VOUS TENTE&nbsp;?<br>INSEREZ LES PIÈCES ET TENTEZ DE REMPORTER DE NOMBREUX LOTS DE PORTE CLEF&nbsp;!!');
        $this->option_groups['default']->addOption('champagne', 'Champagne', '39,90€ / bouteille', 'FAVORI DANS LES GRANDES OCCASIONS ,<br>LE CHAMPAGNE EST UN MUST HAVE DANS NOS BUS.<br>NOUS NOUS OCCUPONS DE VOUS FOURNIR TOUT AU LONG DE LA SOIRÉE GRÂCE À NOTRE CUVÉE PRESTIGE<br>NICOLAS FEUILLATE.');
        $this->option_groups['default']->addOption('wine', 'Vins', '19,90€ / bouteille', 'ROUGE, BLANC OU ROSÉ,<br>IL Y EN A POUR TOUS LES GOÛTS&nbsp;!<br>NOUS VOUS PROPOSONS ÉGALEMENT UNE SÉLECTION<br>DE VINS, POUR ACCOMPAGNER VOS PLATEAUX APÉRITIFS ET COMMENCER LA SOIRÉE TOUT EN DOUCEUR.');
        $this->option_groups['default']->addOption('beer', 'Bière', '1,90€ / bouteille', 'BREVAGE PRÉFÉRÉ DE NOS ÉTUDIANTS,<br>LA BIÈRE FAIT AUSSI TRÈS BIEN L\'AFFAIRE POUR PARTAGER UN DÉBUT DE SOIRÉE À PETIT BUDGET.<br> OUBLIEZ L\'HAPPY HOUR, CHEZ NOUS, C\'EST BIÈRE PAS CHÈRE À VOLONTÉ TOUTE LA SOIRÉE&nbsp;!');
        $this->option_groups['default']->addOption('necklace', 'colliers hawaïens', 'À partir de 70€', 'Soirée à thème ou simple cadeau de bienvenue pour vos convives, pour les faire voyager jusqu\'au bout du monde le temps d\'une soirée&nbsp;!<br><br><span class="bold">Pack (35) : 70€ - Pack (55) : 110€ - Pack (70) : 140€</span>');
        $this->option_groups['default']->addOption('insurance', 'assurance annulation', '100€', 'Un imprévu vous oblige à annuler votre prestation quelques jours avant l\'événement&nbsp;? Avec l\'assurance annulation, vous êtes entièrement remboursé, sans justificatif&nbsp;!');
        $this->option_groups['default']->addOption('karaoke', 'animation karaoké', '10€*', 'POUR LES FANS DE CÉLINE DION ET TOUS LES AUTRES, IL EST TEMPS DE FAIRE RESSORTIR VOS TALENTS DE CHANTEUR AVEC VOS AMIS GRÂCE À NOTRE KARAOKÉ&nbsp;!<br>(UNIQUEMENT DISPONIBLE DANS<br>CERTAINS VÉHICULES)');
        $this->option_groups['default']->addOption('arcade', 'pack arcade', '75€', 'DÉFIER  VOS AMIS  SUR DES JEUX MYTHIQUES COMME PACKMAN OU STREETFIGHTER&nbsp;!<br>CHAUFFEZ VOS DOIGTS ,<br>LA PARTIE VA BIENTÔT COMMENCER...');
        $this->option_groups['default']->addOption('agent', 'agent de sécurité', '200€', 'La sécurité est votre priorité&nbsp;?<br>Nos agents vous proposent un filtrage renforcé à l\'entrée de votre bus et veilleront au bon déroulement de votre soirée. ');
        $this->option_groups['default']->addOption('storage', 'entrepôt', '50€', 'VOUS AVEZ ÉGALEMENT LA POSSIBILITÉ DE DÉPOSER ALCOOLS ET BOISSONS DIRECTEMENT À NOTRE ENTREPÔT,<br>AFIN QUE NOUS PUISSIONS PRÉPARER AU MIEUX VOTRE BUS&nbsp;!');
        $this->option_groups['default']->addOption('card', 'Carton d\'invitation digital', 'Gratuit', 'AJOUTER LA TOUCHE FINALE À VOTRE ÉVÉNEMENT.<br> NOS CARTONS D\'INVITATIONS SONT LE TICKET D\'ENTRÉE POUR UNE SOIRÉE QUI RESTERA GRAVÉE DANS<br>LES MÉMOIRES&nbsp;!');
        $this->option_groups['default']->addOption('frais_bouche', 'frais de bouche', 'gratuit', 'VOUS PENSEZ ÊTRE LE PHILIPPE ETSCHEBEST DE LA CUISINE&nbsp;?<br>DANS CE CAS, N\'HÉSITEZ PAS ET VENEZ FAIRE GOÛTER VOS PETITS PLATS À VOS CONVIVES&nbsp;!');
        $this->option_groups['default']->addOption('droit_bouchon', 'droit de bouchon', 'gratuit', 'QUE DEMANDER DE PLUS QUAND ON PEUT APPORTER SON PROPRE CUVÉ&nbsp;!<br>VENEZ AVEC VOTRE ALCOOL SANS AUCUN FRAIS SUPPLÉMENTAIRE&nbsp;!');
    }
    /**'
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        if (isset($_ENV['CANICULA'])){
            $canicula = $_ENV['CANICULA'] ? true : false;
        } else {
            $canicula = false;
        }
        if (isset($_ENV['HOLIDAY_START']) && isset($_ENV['HOLIDAY_END'])){
            $holiday_start = date('Y-m-d', strtotime($_ENV['HOLIDAY_START']));
            $holiday_end = date('Y-m-d', strtotime($_ENV['HOLIDAY_END']));
            $now = date('Y-m-d');
            $holiday = ($now >= $holiday_start && $now <= $holiday_end);
        } else {
            $holiday = false;
        }
        return $this->render('default/index.html.twig', [
            'current_page'  => 'index',
            'route'         => '',
            'meta_content'  => 'Busdiscothèque est le meilleur choix',
            'bus_types'     => $this->bus_types,
            'canicula'      => $canicula,
            'holiday'      => $holiday,
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
            'route'         => '/bus',
            'bus_types' => $this->bus_types,
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
            'buses' => $this->bus_types['mini']->getBuses(),
            'bus_types' => $this->bus_types,
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
            'buses' => $this->bus_types['middle']->getBuses(),
            'bus_types' => $this->bus_types,
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
            'buses' => $this->bus_types['classic']->getBuses(),
            'bus_types' => $this->bus_types,
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
            'buses' => $this->bus_types['double']->getBuses(),
            'bus_types' => $this->bus_types,
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
            'buses' => $this->bus_types['super']->getBuses(),
            'bus_types' => $this->bus_types,
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
            'bus_types' => $this->bus_types,
        ]);
    }
    /**
     * @Route("/nos-packs", name="packs")
     * @return Response
     */
    public function packs(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('default/packs.html.twig', [
            'current_page' => 'packs',
            'route'         => '/nos-packs',
            'bus_types' => $this->bus_types,
        ]);
    }
    /**
     * @Route("/prix", name="pricing")
     * @return Response
     */
    public function pricing(): \Symfony\Component\HttpFoundation\Response
    {
        $displayed_bus_types = array();
        foreach ($this->bus_types as $k => $bt){
            if (!$bt->isExternal()) $displayed_bus_types[$k] = $bt;
        }
        return $this->render('default/pricing.html.twig', [
            'current_page' => 'pricing',
            'route'         => '/prix',
            'bus_types' => $displayed_bus_types,
        ]);
    }
    /**
     * @Route("/options", name="options")
     * @return Response
     */
    public function options(): \Symfony\Component\HttpFoundation\Response
    {
        $pictures = array(
            "traiteur"  => array(
                array('name' => 'pagnote_alpages', 'title' => 'Pagnote Alpages'),
                array('name' => 'mini_wraps_usa', 'title' => 'Mini Wraps USA'),
                array('name' => 'pagnote_scandinave', 'title' => 'Pagnote Scandinave'),
                array('name' => 'mini_burger', 'title' => 'Mini Burger'),
                array('name' => 'wraps_vegetariens', 'title' => 'Wraps Végétarien'),
                array('name' => 'pagnote_francaise', 'title' => 'Pagnote Française'),
                array('name' => 'pagnote_mini_gougere', 'title' => 'Pagnote Mini Gougère'),
                array('name' => 'pagnote_gourmandise', 'title' => 'Pagnote Gourmandises'),
                array('name' => 'pagnote_macaron', 'title' => 'Pagnote Macaron')
            ),
            "autres"   => array(
                array('name' => 'coin_pusher_1', 'title' => 'Coin Pusher Machine à sous. 💰'),
                array('name' => 'coin_pusher_2', 'title' => 'Tentez de gagner des petits lots sympa 🤩'),
                array('name' => 'batons_lumineux_led', 'title' => 'Bâtons Lumineux Led 🔵'),
                array('name' => 'lunettes_lumineuses_led', 'title' => 'Lunettes lumineuses led 🟣'),
                array('name' => 'bracelets_lumineux_led', 'title' => 'Bracelets Lumineux Led 🟡'),
                array('name' => 'colliers_hawaiens', 'title' => 'Colliers Hawaïens 🟤'),
                array('name' => 'photobooth', 'title' => 'Photobooth 🎞️Souriez vous êtes flashés 📸'),
                array('name' => 'pack_arcade_pac_man', 'title' => 'Pack Arcade Pac-Man 🕹🎮'),
                array('name' => 'plus_belles_photos', 'title' => 'Faites vos plus belles photos 📸'),
                array('name' => 'gateau_bonbons', 'title' => 'Gâteau De bonbon 🍬🍭'),
                array('name' => 'pack_arcade_mortal_kombat', 'title' => 'Pack Arcade Mortal Kombat 🕹🎮'),
                array('name' => 'decorez_bus', 'title' => 'Décorez le bus selon vos envies 😍'),
            )
        );
        return $this->render('default/options.html.twig', [
            'current_page'  => 'options',
            'route'         => '/options',
            'groups'        => $this->option_groups,
            'pictures'      => $pictures,
            'bus_types'     => $this->bus_types,
        ]);
    }
    /**
     * @Route("/photo", name="photo")
     * @return Response
     */
    public function photo(): \Symfony\Component\HttpFoundation\Response
    {
        $photos = array(
            array(
                'name'  => 'interieur',
                'title' => 'Nos photos d\'intérieur',
                'count' => 20
            ),
            array(
                'name'  => 'exterieur',
                'title' => 'Nos photos d\'extérieur',
                'count' => 18
            ),
            array(
                'name'  => 'vintage',
                'title' => 'Nos photos vintage',
                'count' => 20
            ),
        );
        return $this->render('default/photo.html.twig', [
            'current_page'  => 'photo',
            'route'         => '/photo',
            'photos'      => $photos,
            'bus_types'     => $this->bus_types,
        ]);
    }
    /**
     * @Route("/video", name="video")
     * @return Response
     */
    public function video(): \Symfony\Component\HttpFoundation\Response
    {
        $videos = array(
            array(
                'title'     => 'Nos packs anniversaire / photobooth / ballons',
                'content'   => array(
                    array('name'=>'pack_1_anniversaire','title'=>'Pack anniversaire'),
                    array('name'=>'pack_2_anniversaire_noel','title'=>'Pack anniversaire Noël'),
                    array('name'=>'pack_3_anniversaire_ballons','title'=>'Pack anniversaire & ballons'),
                    array('name'=>'pack_4_anniversaire_photobooth','title'=>'Pack anniversaire et Photobooth'),
                ),
            ),
            array(
                'title'     => 'Présentation des bus',
                'content'   => array(
                    array('name'=>'bus_1_yoshi','title'=>'BUS YOSHI'),
                    array('name'=>'bus_2_jeffline','title'=>'BUS JEFFLINE'),
                    array('name'=>'bus_3_condor','title'=>'BUS CONDOR'),
                )
            ),
            array(
                'title'     => 'Notre dancefloor',
                'content'   => array(
                    array('name'=>'dancefloor_1','title'=>'Bus intérieur 1'),
                    array('name'=>'dancefloor_2','title'=>'Bus intérieur 2'),
                    array('name'=>'dancefloor_3','title'=>'Bus intérieur 3'),
                )
            ),
            array(
                'title'     => 'Nos ambiances',
                'content'   => array(
                    array('name'=>'ambiance_1','title'=>'Ambiance 1'),
                    array('name'=>'ambiance_2','title'=>'Ambiance 2'),
                    array('name'=>'ambiance_3','title'=>'Ambiance 3'),
                )
            ),
            array(
                'title'     => 'Un regard extérieur',
                'content'   => array(
                    array('name'=>'exterieur_1','title'=>'Extérieur 1'),
                    array('name'=>'exterieur_2','title'=>'Extérieur 2'),
                    array('name'=>'exterieur_3','title'=>'Extérieur 3'),
                    array('name'=>'exterieur_4','title'=>'Extérieur 4'),
                )
            ),
            array(
                'title'     => 'Pour plus de fun !',
                'content'   => array(
                    array('name'=>'fatal_1','title'=>'Fatal 1'),
                    array('name'=>'fatal_2','title'=>'Fatal 2'),
                    array('name'=>'fatal_3','title'=>'Fatal 3'),
                )
            ),
        );
        return $this->render('default/video.html.twig', [
            'current_page'  => 'video',
            'route'         => '/video',
            'videos'      => $videos,
            'bus_types'     => $this->bus_types,
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
            'bus_types' => $this->bus_types,
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
            'bus_types' => $this->bus_types,
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
            'bus_types' => $this->bus_types,
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
        //$amount = str_replace(',','.',$amount * 100;
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
                'bus_types' => $this->bus_types,
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
            $amount = 100;
        }
        return $this->redirectToRoute('stripe',array('amount' => $amount));
    }
}