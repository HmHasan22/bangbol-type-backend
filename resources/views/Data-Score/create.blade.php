@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Create Score</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('score.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            </div>
                            <div class="input-group mb-3">
                                <input type="hidden" name="id" value="{{$score->id}}">
                                <input type="hidden" name="home_team" value="{{$score->hometeam}}">
                                <input type="hidden" name="away_team" value="{{$score->awayteam}}">
                                <input type="hidden" name="match_date" value="{{$score->date}}">
                                <input type="text" class="form-control"
                                       name="score" placeholder="Score" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
