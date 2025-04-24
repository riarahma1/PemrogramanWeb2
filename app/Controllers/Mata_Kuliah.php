<?php

namespace App\Controllers;

class Mata_Kuliah extends BaseController
{
    public function pemweb(): string
    {
        return view('mata_kuliah/pemweb');
    }
    public function visualisasi_data(): string
    {
    return view('mata_kuliah/visualisasi_data');
    }
    public function mbd(): string
    {
        return view('mata_kuliah/mbd');
    }
    public function mpSI(): string
    {
        return view('mata_kuliah/mpSI');
    }
}