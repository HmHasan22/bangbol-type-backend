@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{-- message start--}}
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success my-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            {{-- message end--}}
            {{--  data start --}}
            @if(count($league) > 0)
                @foreach ($league as $value)
                    @foreach($value as $item)
                        <div class="col-lg-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    {{--date--}}
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p>{{$item->date}}</p>
                                        </div>
                                        <div>
                                            <p>{{$item->hometeam}}</p>
                                            <p>{{$item->awayteam}}</p>
                                        </div>
{{--                                        <div class="d-flex flex-column">--}}
{{--                                            @foreach($item->section as $i)--}}
{{--                                                @foreach($i as $object)--}}
{{--                                                    <div--}}
{{--                                                        class="@if($object->name == "Home") order-0 @else order-1 @endif">--}}
{{--                                                        <p>@if($object->name == "Home")--}}
{{--                                                                {{$object->odds}}--}}
{{--                                                            @elseif($object->name == "Away")--}}
{{--                                                                {{$object->odds}}--}}
{{--                                                            @endif</p>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
                                        <div>
                                            @isset($item->score->score)
                                                <a href="{{ route('score.destroy',$item->score->id) }}"
                                                   class="btn">
                                                    <img height="20px" width="20px" class="img-fluid"
                                                         src="{{asset('delete.png')}}" alt="">
                                                </a>
                                            @endisset
                                            @empty($item->score->score)
                                                <a href="{{ route('score.create',$item->id) }}"
                                                   class="btn">
                                                    <img height="20px" width="20px" class="img-fluid"
                                                         src="{{asset('edit.png')}}" alt="">
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                    <div>
                                        @isset($item->score->score)
                                            <p>{{$item->score->score}}</p>
                                        @endisset
                                        @empty($item->score->score)
                                            <p>Add match results.</p>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @else
                <h2 class="text-center text-danger">No Data Found</h2>
            @endif
            {{--  data end --}}
        </div>
    </div>
@endsection
