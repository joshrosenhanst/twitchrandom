<?php

use App\Slogan;

class SloganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $slogans = Slogan::get();
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });

        return View::make('slogans', array(
          "slogans"=>$slogans,
          "games_list"=>$games_list,
          "random_text"=>$this->getRandomText()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Slogan::create(

        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
