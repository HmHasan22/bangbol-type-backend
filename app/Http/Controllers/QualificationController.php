<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function store(Request $request)
    {
        Qualification::truncate();
        foreach($request->qualifications as $item)
            Qualification::create([
                'qualification' =>$item ,
            ]);
        return redirect()->back()->with("success","API SUCCESSFULLY UPDATED");
    }
}
