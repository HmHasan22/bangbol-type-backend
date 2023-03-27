<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index()
    {
        $data = League::get()->all();
        return view("league.index", compact('data'));
    }

    public function create()
    {
        return view("league.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'This field is required',
            'name.max' => 'Value is too long!'
        ]);
        League::create($request->all());
        return redirect('/league')->with("success", 'League Create Successfully');
    }

    public function edit($id)
    {    $data = League::find($id);
        return view("league.edit",compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'This field is required',
            'name.max' => 'Value is too long!'
        ]);

        $league = League::find($request->id);
        $league->name = $request->name;
        $league->save();
        return redirect('/league')->with("success", 'League Update Successfully');
    }

    public function destroy($id)
    {
        $data = League::find($id);
        $data->delete();
        return redirect('/league')->with("success", 'League Delete Successfully');
    }
}
