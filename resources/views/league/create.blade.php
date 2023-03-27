@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Create League</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('create-league') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input  type="text" class="form-control @error('name') is-invalid
                                @enderror" name="name" placeholder="League Name">
                                <div class="invalid-feedback">
                                    @error('name')
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
