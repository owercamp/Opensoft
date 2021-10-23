<?php

use App\Models\MatrixEPP;
use Illuminate\Database\Seeder;

class MatrizEPPSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(MatrixEPP::class, 50)->create();
  }
}
