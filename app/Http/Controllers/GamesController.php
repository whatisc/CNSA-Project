<?php

namespace App\Http\Controllers;

use App\Player;
use App\PlayerStat;
use App\Person;
use App\GameStat;
use App\InjuryLog;
use App\Injury;
use App\Game;
use App\Stadium;
Use App\Team;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function __construct()
    {
        //Guests can see everything except for these views
        //$this->middleware('guest', ['except' => 'create', 'edit', 'update', 'delete', 'store']);
        //Coaches can see everything except delete functionality
        //$this->middleware('coach', ['except' => 'delete']);
        //Admins can see everything
        //$this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();

        $index = 0;

        $i = 0;
        foreach ($games as $game)
        {
            // find the stadium for each game
            $stadium[$i] = Stadium::find($game->stadiumId);       
            
            
            // this returns a collection into the gameStats array
            $gameStats[$i] = GameStat::all()->where('gameId', $game->statId);


            // remainder
            if (($index % 2) == 1)
            {
                $index += 1;
            }    

            // find the team based on teamId on gameStats array element
            $teams1[$i] = Team::find($gameStats[$i]->get($index)->teamId);
            
            // find the second team by adding +1 in the get area of the collection
            $teams2[$i] = Team::find($gameStats[$i]->get($index+1)->teamId);

            $i += 1;
            $index += 1;
        }

        return view('games.index', compact('games', 'stadium', 'gameStats', 'teams1', 'teams2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        // declare stat models

        $game = new Game;
        $game->gameDate = $request->gameDate;
        $game->gameAttendance = $request->gameAttendance;
        $game->stadiumId = $request->stadiumId;
        $game->save();
        
        $gameStat1 = new GameStat; 
        $gameStat1->teamScore = $request->teamScore1;
        $gameStat1->teamId = $request->teamId1;
        $gameStat1->gameId = $game->statId;
        $gameStat1->save();
        
        $gameStat2 = new GameStat; 
        $gameStat2->teamScore = $request->teamScore2;
        $gameStat2->teamId = $request->teamId2;
        $gameStat2->gameId = $game->statId;
        $gameStat2->save(); 

        return redirect("/games");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //dd($request);

        //$game = Game::find($request->statId);

        $game = Game::find($request->gameId);

        $players = PlayerStat::all()->where('gameId', $request->gameId);

        $teams = GameStat::all()->where('gameId', $request->gameId);

        $stadium = Stadium::find($game->stadiumId);

        $injuries = InjuryLog::all()->where('gameId', $request->gameId);

        // dd($teams, $players);
        
        $teamName1 = Team::find($teams->get(0)->teamId);
        $teamName2 = Team::find($teams->get(1)->teamId);

        $i = 0;
        foreach ($injuries as $injury)
        {
            $injuryNames[$i] = Injury::find($injury->injuryId);
            $i += 1;
        }

        $playerStatsTeam1 = PlayerStat::all()->where('teamId', $teamName1->teamId);
        $playerStatsTeam2 = PlayerStat::all()->where('teamId', $teamName2->teamId);


        return view('games.show', compact(['game', 'teamName1', 'teamName2', 'stadium', 'playerStatsTeam1', 'playerStatsTeam2', 'injuries', 'injuryNames']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit($gameId)
    {

        $game = Game::find($gameId);

        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $statId)
    {
        /*
        //put validation here**

        //Retrieves the player
        $game = Game::find($statId);
        $gameStats = GameStats::where('gameId', $statId);

        //Updates the player
        $game->gameDate = $request->gameDate;
        $player->gameAttendance = $request->gameAttendance;
        $player->stadiumId = $request->stadiumId;

        //Updates the person
        $gameStats[0]->personFirstName = $request->firstName;
        $person->personLastName = $request->lastName;

        //Saves both
        $player->save();
        $person->save();


        //Flashes a message to let the user know that they have updated a player
        session()->flash('message', 'Player has been updated');

        //Redirects the user back to the players page
        return redirect('/players');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $game = Game::find($request->gameId);
        $game->delete();
        return redirect('/games')->with('success', 'Game Deleted');
    }
}
