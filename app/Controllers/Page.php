<?php namespace App\Controllers;

class Page extends BaseController
{
    public function About()
    {
        echo "about page";
    }

    public function Contact()
    {
        echo "contact page";
    }

    public function Faqs()
    {
        echo "faqs page";
    }

    public function Tos()
    {
        echo "Halaman Term of Service";
    }

    public function Biodata()
    {
        echo "<h1>Biodata</h1>";
        echo "<p><strong>Nama</strong> : Ria Rahmayati Nur Humairoh</p>";
        echo "<p><strong>Tempat, Tanggal Lahir</strong> : Jombang, 23 April 2005</p>";
        echo "<p><strong>Alamat</strong> : Dsn. Cangkringmalang, Ds. Carangrejo Kec. Kesamben Kab. Jombang</p>";

    }
}
