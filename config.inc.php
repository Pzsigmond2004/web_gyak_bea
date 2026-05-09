<?php
$ablakcim = array(
    'cim' => 'Web-programozás 1 – Gyakorlat Beadandó feladat',
);

$fejlec = array(
    'kepforras' => 'logo.png',
    'kepalt'    => 'logo',
    'cim'       => 'Web-programozás 1 – Gyakorlat Beadandó feladat',
    'motto'     => ''
);

$lablec = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'ceg'       => 'Oskola Milán - GXRHGB Papp Zsigmond - YHXBSP'
);

/*
 * OLDALAK DEFINÍCIÓJA
 * menun => array( NINCS_BEJELENTKEZVE, BE_VAN_JELENTKEZVE )
 * 1 = megjelenik
 * 0 = nem jelenik meg
 */
$oldalak = array(
    '/' => array(
        'fajl'   => 'cimlap',
        'szoveg' => 'Főoldal',
        'menun'  => array(1, 1)
    ),

    'kepek' => array(
        'fajl'   => 'kepek',
        'szoveg' => 'Képek',
        'menun'  => array(1, 1)
    ),

    'kapcsolat' => array(
        'fajl'   => 'kapcsolat',
        'szoveg' => 'Kapcsolat',
        'menun'  => array(1, 1)
    ),

    
    'uzenetek' => array(
    'fajl'   => 'uzenetek',
    'szoveg' => 'Üzenetek',
    'menun'  => array(0, 1)
    ),


    'crud' => array(
        'fajl'   => 'crud',
        'szoveg' => 'CRUD',
        'menun'  => array(1, 1)
    ),

    /* BELÉPÉS – csak ha NINCS belépve */
    'belepes' => array(
        'fajl'   => 'belepes',
        'szoveg' => 'Bejelentkezés',
        'menun'  => array(1, 0)
    ),

    /* KILÉPÉS – csak ha BE van lépve */
    'kilepes' => array(
        'fajl'   => 'kilepes',
        'szoveg' => 'Kilépés',
        'menun'  => array(0, 1)
    ),

    /* TECHNIKAI OLDALAK – nem menüpontok */
    'belep' => array(
        'fajl'   => 'belep',
        'szoveg' => '',
        'menun'  => array(0, 0)
    ),

    'regisztral' => array(
        'fajl'   => 'regisztral',
        'szoveg' => '',
        'menun'  => array(0, 0)
    )
);

/*
 * HIBA OLDAL (404)
 */
$hiba_oldal = array(
    'fajl'   => '404',
    'szoveg' => 'A keresett oldal nem található!'
);
?>
