<?php

use App\Models\Documentmanagerial;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      "id" => "1024500065",
      "firstname" => "OWER ARMANDO",
      "lastname" => "CAMPOS ALFONSO",
      "email" => "owerion22@gmail.com",
      "password" => bcrypt('LoreCamiJuli1')
    ])->assignRole('ADMINISTRADOR SISTEMA');

    // User::create([
    //   "id" => "1024537577",
    //   "firstname" => "BRAYAN JULIAN",
    //   "lastname" => "RODRIGUEZ MORENO",
    //   "email" => "brayanjulianrodriguezmoreno23@gmail.com",
    //   "password" => bcrypt('bjrodriguemo')
    // ])->assignRole('ADMINISTRADOR SISTEMA');

    User::create([
      "id" => "80503717",
      "firstname" => "JAVIER",
      "lastname" => "VARGAS PRIETO",
      "email" => "javapri@outlook.com",
      "password" => bcrypt('javapri')
    ])->assignRole('ADMINISTRADOR SISTEMA');
  }
}
