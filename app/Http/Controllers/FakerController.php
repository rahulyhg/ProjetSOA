<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Faker;

class FakerController extends Controller
{


    public function test (){

        $faker = Faker\Factory::create('fr_FR');
        return ($faker->realText);

    }
}
