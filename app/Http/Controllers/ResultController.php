<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResultResource;
use App\Models\League;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Result::with('league')->get();
        return view('result.index', compact('data'));
    }

    public function response()
    {
        $data = Result::with('league')->get();
//        return $data;
//        $data = Result::with('league')->get()->groupBy("league.name");
//        return $data;
        return response()->json([
            'status' => true,
            'data' => ResultResource::collection($data)->groupBy("league.name"),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $league = League::all();
        return view("result.create", compact('league'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'league_id' => 'required',
            'home_team' => 'required',
            'away_team' => 'required',
            'result_one' => 'required',
            'result_two' => 'required',
            'date' => 'required',
        ], [
            'league_id.required' => 'This field is required',
            'home_team.required' => 'This field is required',
            'away_team.required' => 'This field is required',
            'result_one.required' => 'This field is required',
            'result_two.required' => 'This field is required',
            'date.required' => 'This field is required',
        ]);
        $data = new Result;
        $data->league_id = $request->league_id;
        $data->home_team = $request->home_team;
        $data->away_team = $request->away_team;
        $data->result_one = $request->result_one;
        $data->result_two = $request->result_two;
        $data->date = $request->date;
        $data->save();
        return redirect('/result')->with("success", 'Result Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Result::with('league')->where('id', $id)->get();
        $league = League::all();
        return view('result.edit', compact('data', 'league'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'league_id' => 'required',
            'home_team' => 'required',
            'away_team' => 'required',
            'result_one' => 'required',
            'result_two' => 'required',
            'date' => 'required',
        ], [
            'league_id.required' => 'This field is required',
            'home_team.required' => 'This field is required',
            'away_team.required' => 'This field is required',
            'result_one.required' => 'This field is required',
            'result_two.required' => 'This field is required',
            'date.required' => 'This field is required',
        ]);
        $data = Result::find($request->id);
        // dd($request->id);
        $data->league_id = $request->league_id;
        $data->home_team = $request->home_team;
        $data->away_team = $request->away_team;
        $data->result_one = $request->result_one;
        $data->result_two = $request->result_two;
        $data->date = $request->date;
        $data->save();
        return redirect('/result')->with("success", 'Result Update Successfully');
        // dd($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Result::find($id);
        $data->delete();
        return redirect('/result')->with("success", 'League Delete Successfully');
    }
}
