<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utils\Jwt;
use App\Utils\PushToWS;
use DB;
use App\Tasklist;
use React;

class TasklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $payload = Jwt::validate($request->header('Authorization'));;
      $tasklist = Tasklist::all()->first();

      $newTasklist = (object)([
          "task"  => $request->task,
          "status" => $request->status,
          "note"   => $request->note,
      ]);
      $actualTaskList = json_decode($tasklist->tasklist);
      $id = $request->input('id');

      if (isset($id)) {
        foreach ($actualTaskList as $key => $task) {
          if($task->id == $id){
            $newTasklist->id = $id;
            $actualTaskList[$key] = $newTasklist;
          }
        }
      }else{
        $newTasklist->id = uniqid();
              $actualTaskList[] = $newTasklist;
      }


      //$newTasklistEncoded = json_encode($newTasklist);
      $tasklist->tasklist = json_encode($actualTaskList);
      $tasklist->save();
      PushToWS::push($tasklist);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id      dd($tasklist);
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Get the tasklist.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUi(Request $request){
      // on récupère le payload et on valide qu'il soit corect
      $payload = Jwt::validate($request->header('Authorization'));

        // On récupère la tasklist dans la base de données
      $tasklist = Tasklist::all()->first();
        // Si la tasklist est inexistante on renvoit une erreur
      if(!isset($tasklist)){
        return "not ok";
      }
      return $this->jsonView('tasklist.ui',["tasklist"=>$tasklist->tasklist]);
    }
}
