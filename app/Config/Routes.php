<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/About','Page::about');
$routes->get('/Contact','Page::contact');
$routes->get('/Faqs','Page::faqs');
$routes->get('/Tos','Page::tos');
$routes->get('/Biodata','Page::biodata');


$routes->setAutoRoute(true);


