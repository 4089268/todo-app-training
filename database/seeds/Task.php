<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Todo;

class Task extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	Todo::create(['text' => 'ir a almorzar a las 8:00',]);
    	Todo::create(['text' => 'ir a comer a las 16:00',]);
    	Todo::create(['text' => 'ir a cenar  a las 21:00',]);

    }
}
	