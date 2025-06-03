<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Unipdu Press',
        ];
        echo view('pages/home', $data);

    }
    public function about()
    {
        $data = [
            'title' => 'Tentang',
        ];
        echo view('pages/about', $data);
    }
        public function contact()
    {
        $data = [
            'title' => 'Hubungi Kami',
            'alamat' => 
            [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Kesamben',
                    'kota' => 'Jombang',
                ],
                [
                    'tipe' => 'Kampus',
                    'alamat' => 'Peterongan',
                    'kota' => 'Jombang',
                ],
            ],
        ];
        echo view('pages/contact', $data);
    }
}

?>