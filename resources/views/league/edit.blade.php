@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Update League</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update-league') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input  type="text" class="form-control @error('name') is-invalid
                                @enderror" name="name" placeholder="League Name" value="{{ $data->name }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                  </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
