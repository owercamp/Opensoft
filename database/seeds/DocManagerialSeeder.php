<?php

use App\Models\Documentmanagerial;
use Illuminate\Database\Seeder;

class DocManagerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Documentmanagerial::class, 50)->create();
    }
}
