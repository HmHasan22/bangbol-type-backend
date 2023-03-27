<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Qualification;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $data = Post::whereIn(
            'competition', Qualification::pluck("qualification")
        )->with('score')->get();
        $league = PostResource::collection($data)->collection->groupBy("competition");
        return view("Data-Score.index", compact('league'));
    }

    public function create($id)
    {

        $score = Post::where('id',$id)->first();
        return view("Data-Score.create", compact('score'));
    }

    public function store(Request $request)
    {
        $previousId = Score::where('post_id', $request->id)->first();
        if ($previousId == null) {
            try {
                $score = new Score();
                $score->post_id = $request->id;
                $score->score = $request->score;
                $score->home_team = $request->home_team;
                $score->away_team = $request->away_team;
                $score->match_date = $request->match_date;
                $score->save();
                return redirect()->route("score.index")->withSuccess("Score Successfully  Created! ");
            } catch (\Exception $e) {
                dd($e);
            }

        }

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy($id)
    {
        $score = Score::find($id);
        if ($score != null) {
            $score->delete();
        }
        return redirect()->route("score.index")->withSuccess("Score Successfully  Deleted! ");
    }
}
