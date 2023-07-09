<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'first_name'=>'anas',
            'last_name'=>'rahman',
            'companyId'=>1,
            'email'=>'anazrahman@gmail.com',
            'phone'=>'1234567890'
        ]);

        Employee::create([
            'first_name'=>'mubu',
            'last_name'=>'rahman',
            'companyId'=>1,
            'email'=>'anazrahman@gmail.com',
            'phone'=>'1234567890'
        ]);

        Employee::create([
            'first_name'=>'sidu',
            'last_name'=>'rahman',
            'companyId'=>1,
            'email'=>'anazrahman@gmail.com',
            'phone'=>'1234567890'
        ]);

        Employee::create([
            'first_name'=>'vish',
            'last_name'=>'rahman',
            'companyId'=>1,
            'email'=>'anazrahman@gmail.com',
            'phone'=>'1234567890'
        ]);

        Employee::create([
            'first_name'=>'anfas',
            'last_name'=>'rahman',
            'companyId'=>1,
            'email'=>'anazrahman@gmail.com',
            'phone'=>'1234567890'
        ]);
    }
}
