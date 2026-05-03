<?php

namespace Database\Seeders;

use App\Models\SystemUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = SystemUser::where("email","raya@gmail.com")->first();
        if(!$admin){
            SystemUser::create([
                "firstname" => "Raya",
                "middlename" => "bakari",
                "lastname" => "Juma",
                "email" => "raya@gmail.com",
                "phone" => "077383949",
                "role" => "admin",
                "password" => Hash::make("12345"),
                
            ]);
        }
    }
}
