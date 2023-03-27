@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card py-5">
                    <div class="text-center">
{{--                        <img src="{{asset("logo.png")}}" alt="">--}}
                    </div>
                    <div class="text-center display-4">Welcome to Tip Score API</div>
                    <div class="row m-auto mt-4">
                        <div class="col-6">
                            <a href="{{ route('login') }}" class="btn text-center btn-primary">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
