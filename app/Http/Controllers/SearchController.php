<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use View;

class SearchController extends Controller
{
    public function search(Request $request) {
        $exp = explode(' ', $request->search);
        $s = '';
        $c = 1;

        // On explose les termes de la recherche pour pouvoir tous les rechercher
        foreach ($exp as $e)
        {
            $s .= "+$e*";
            if ($c + 1 == count($exp))
                $s .= ' ';
            $c++;
        }
        // On recherche les différents termes dans notre base de données
        $texts = DB::table('texts')
            ->whereRaw(DB::raw("MATCH(title, body) AGAINST('".$s."' IN BOOLEAN MODE)"))->get();

        $results = [];
        $i = 0;
        //dd($texts);

        // On reconstruit un tableau avec les informations que l'on veut, soit le title et le body
        foreach($texts as $text){
            dd($text);
       }
        //  dd(json_decode(json_encode($results),FALSE));
        return View::make('search')->with('results',['result'=>json_decode(json_encode($results),FALSE) ]);
    }
}