<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //     'nama' => 'J.K. Rowling',
        //     'address' => 'Edinburgh, Scotland',
        //     'created_at' => Time::now(),
        //     'updated_at' => Time::now(),
        //     ],
        //     [
        //     'nama' => 'George R.R. Martin',
        //     'address' => 'Bayonne, New Jersey, USA',
        //     'created_at' => Time::now(),
        //     'updated_at' => Time::now(),
        //     ],
        //     [
        //     'nama' => 'J.R.R. Tolkien',
        //     'address' => 'Bloemfontein, South Africa',
        //     'created_at' => Time::now(),
        //     'updated_at' => Time::now(),
        //     ]
        // ];

        $faker = \Faker\Factory::create('id_ID');
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'nama' => $faker->name,
                'address' => $faker->address,
                'email' => $faker->email,
                'telepon' => $faker->phoneNumber,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now(),
            ];
        }
        
        //Simple Queries
        // $this->db->query('INSERT INTO penulis(nama, address, created_at, updated_at) VALUES(:nama:, :address:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        $this->db->table('penulis')->insertBatch($data);
    }
}
