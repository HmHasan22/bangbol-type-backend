<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\ScoreResource;
use App\Models\Score;
use Exception;
use App\Models\Post;
use App\Models\Qualification;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            $data = Post::whereIn(
                'competition', Qualification::pluck("qualification"),
            )->with('score')->get();
            return response()->json([
                'status' => true,
                'data' => PostResource::collection($data)->collection->groupBy("competition"),
            ], 200);
        } else {
            return "something went wrong";
        }
    }


    public function data(Request $request)
    {
        if ($request->is('api/*')) {
            $data = Post::whereIn(
                'competition', Qualification::pluck("qualification"),
            )->with('score')->get();

            $data = collect($data)->map(function ($item) {

                $dateArr = explode('/', $item->date);
                $date = "$dateArr[2]/$dateArr[1]/$dateArr[0]";

                return [
                    'id' => $item->id,
                    'competition' => $item->competition,
                    'matches' => [
                        'hometeam' => $item->hometeam,
                        'awayteam' => $item->awayteam,
                        'titlelong' => $item->titlelong,
                        'score' => new ScoreResource($item->load('score')),
                        'date' => $date,
                        'section' => $item->section,
                    ]
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $data
//                'data' => PostResource::collection($data)->groupBy("competition")
            ], 200);
        } else {
            return "something went wrong";
        }
    }


    public function category()
    {
        $data = Post::pluck('competition')->unique();
        $qualification = Qualification::pluck('qualification');
        return view("score.score", compact('data', 'qualification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $xmlString = file_get_contents('http://oddsfeed.new.188games.com/OddsFeed/188BET/default/V1.0/GetOdds.aspx?language=ALL&event=ALL&market=ALL&sportsid=1&bettype=8_2');
        // $xmlObject = simplexml_load_string($xmlString);
        // $json = json_encode($xmlObject);
        // $phpArray = json_decode($json, true);
        // try {
        //     foreach ($phpArray['odds']['FixtureEvent'] as $value) {
        //         Post::create([
        //             'competition' => $value['@attributes']['competition'],
        //             'competitionCht' => $value['@attributes']['competitionCht'],
        //             'competitionChs' => $value['@attributes']['competitionChs'],
        //             'competitionKor' => $value['@attributes']['competitionKor'],
        //             'competitionVie' => $value['@attributes']['competitionVie'],
        //             'hometeam' => $value['@attributes']['hometeam'],
        //             'hometeamCht' => $value['@attributes']['hometeamCht'],
        //             'hometeamChs' => $value['@attributes']['hometeamChs'],
        //             'hometeamKor' => $value['@attributes']['hometeamKor'],
        //             'hometeamVie' => $value['@attributes']['hometeamVie'],
        //             'awayteam' => $value['@attributes']['awayteam'],
        //             'awayteamCht' => $value['@attributes']['awayteamCht'],
        //             'awayteamKor' => $value['@attributes']['awayteamKor'],
        //             'awayteamChs' => $value['@attributes']['awayteamChs'],
        //             'awayteamVie' => $value['@attributes']['awayteamVie'],
        //             'date' => $value['@attributes']['date'],
        //             'time' => $value['@attributes']['time'],
        //             'title' => $value['marketline']['@attributes']['title'],
        //             'titlelong' => $value['marketline']['@attributes']['titlelong'],
        //             'section' => json_encode($value['marketline']['selection']),
        //         ]);
        //     }
        // } catch (Exception $e) {
        //     dd($e);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
