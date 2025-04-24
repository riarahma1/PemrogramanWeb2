<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index(): string
    {
        return view('Profil/view_profil');
    }
    public function kontak_saya(): string
    {
        return view('Profil/kontak_saya');
    }
}
