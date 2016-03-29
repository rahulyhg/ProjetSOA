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

        foreach ($exp as $e)
        {
            $s .= "+$e*";
            if ($c + 1 == count($exp))
                $s .= ' ';
            $c++;
        }
        $texts = DB::table('texts')
            ->whereRaw(DB::raw("MATCH(title, body) AGAINST('".$s."' IN BOOLEAN MODE)"))->get();
        $results = [];
        $i = 0;

        foreach($texts as $text){
            $array['body'] = $text->body;
            $array['title'] = $text->title;
           $results[$i]['data'] = $array;
           $i++;
       }
        $resultsEncoded = json_encode($results);
        return View::make('search')->with('results',$resultsEncoded);
    }
}
