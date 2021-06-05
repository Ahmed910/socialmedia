<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag=new Tag([
            'name'=>'Tutorial'
        ]);
        $tag->save();
        $tag=new Tag([
            'name'=>'laravel'
        ]);
        $tag->save();
    }
}
