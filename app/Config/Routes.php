<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/About','Page::about');
$routes->get('/Contact','Page::contact');
$routes->get('/Faqs','Page::faqs');
$routes->get('/Tos','Page::tos');
$routes->get('/Biodata','Page::biodata');

$routes->get('/', 'Profil::index');

$routes->get('mata_kuliah/pemweb', 'Mata_Kuliah::pemweb');
$routes->get('mata_kuliah/visualisasi_data', 'Mata_Kuliah::visualisasi_data');
$routes->get('mata_kuliah/mbd', 'Mata_Kuliah::mbd');
$routes->get('mata_kuliah/mpSI', 'Mata_Kuliah::mpSI');
$routes->get('profil/kontak_saya', 'Profil::kontak_saya');


$routes->setAutoRoute(true);


