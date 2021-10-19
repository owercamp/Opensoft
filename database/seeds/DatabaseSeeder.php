<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    $this->troncateTable([
      "users",
      "permissions",
      "roles",
      "documentsmanagerial"
    ]);
    $this->call(RolesAndPermissionsSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(DocManagerialSeeder::class);
  }

  function troncateTable(array $tables)
  {

    DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

    foreach ($tables as $table) {
      //Vaciar la tabla de los registros que tenga
      DB::table($table)->truncate();
    }
    //Activa la revisión de llaves foraneas
    DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
  }
}
