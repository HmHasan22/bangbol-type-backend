@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Create Result</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('result.store') }}" method="POST">

                            @csrf
                            <div class="mb-3">
                                <select name="league_id" class="form-control @error('league_id') is-invalid @enderror">
                                    <option value="">Select Leauge</option>
                                    @foreach ($league as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('league_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('home_team') is-invalid @enderror"
                                    name="home_team" placeholder="Home Team">
                                <div class="invalid-feedback">
                                    @error('home_team')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('away_team') is-invalid @enderror"
                                    name="away_team" placeholder="Away Team" value="{{ old('away_team') }}">
                                <div class="invalid-feedback">
                                    @error('away_team')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('result_one') is-invalid @enderror"
                                    name="result_one" placeholder="Result One" value="{{ old('result_one') }}">
                                <div class="invalid-feedback">
                                    @error('result_one')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('result_two') is-invalid @enderror"
                                    name="result_two" placeholder="Result Two" value="{{ old('result_two') }}">
                                <div class="invalid-feedback">
                                    @error('result_two')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="date" value="{{ old('date') }}">
                                <div class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
