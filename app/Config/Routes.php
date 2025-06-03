<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// //$routes->get('/', 'Home::index');
// $routes->get('/About','Page::about');
// $routes->get('/Contact','Page::contact');
// $routes->get('/Faqs','Page::faqs');
// $routes->get('/Tos','Page::tos');
// $routes->get('/Biodata','Page::biodata');

// $routes->get('mata_kuliah/pemweb', 'Mata_Kuliah::pemweb');
// $routes->get('mata_kuliah/visualisasi_data', 'Mata_Kuliah::visualisasi_data');
// $routes->get('mata_kuliah/mbd', 'Mata_Kuliah::mbd');
// $routes->get('mata_kuliah/mpSI', 'Mata_Kuliah::mpSI');
// $routes->get('profil/kontak_saya', 'Profil::kontak_saya');

$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');
$routes->get('/books', 'Books::index');
$routes->get('/books/create', 'Books::create');
$routes->post('/books/save', 'Books::save');

$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
$routes->delete('/books/(:num)', 'Books::delete/$1');
$routes->get('/books/(:any)', 'Books::detail/$1');

