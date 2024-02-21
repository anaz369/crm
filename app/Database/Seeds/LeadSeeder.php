<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) { // Insert 10 fake records
            $data = [
                'customer_name' => $faker->name,
                'company_name' => $faker->company(),
                'email' => $faker->unique()->email,
                'mobile_number' => $faker->phoneNumber,
                'referred_by' => $faker->name,
                'date_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'status'=> $faker->randomElements([1,2,3,4,5]),
                'added_by' => $faker->randomElements([1,2,3])
                
                
            ];

            $this->db->table('tbl_leads')->insert($data);
        }
    }
}