@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (Session::has('success'))
                    <div class="alert alert-success my-3">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>League</div>
                        <div>
                            <a href="{{ route('add-league') }}" class="btn btn-primary">+ Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($data) > 0)
                            <table class="table">
                                <thead>
                                    <th>SL</th>
                                    <th>League</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value)
                                        <tr>
                                            <td width="10%">{{ $loop->iteration }}</td>
                                            <td width="70%">{{ $value->name }}</td>
                                            <td width="20%">
                                                <a href="{{ route('edit-league', $value->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ route('delete-league', $value->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2 class="text-center text-danger">No Data Found</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
