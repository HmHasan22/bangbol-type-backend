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
                        <div>
                            {{ __('Dashboard') }}</div>
                        <a href="{{ route('result.create') }}" class="btn btn-primary">+ Add New</a>
                    </div>
                    <div class="card-body">
                        {{-- <table class="table">
                            <thead>
                                <th>SL</th>
                                <th>League</th>
                                <th>Home Team</th>
                                <th>Away Team</th>
                                <th>Result One</th>
                                <th>Result Two</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Indian Premiur League</td>
                                    <td>Barcalona</td>
                                    <td>Real Madrid</td>
                                    <td>Soon</td>
                                    <td>Soon</td>
                                    <td>
                                        <button type="button" class="btn btn-success">Edit</button>
                                        <button type="button" class="btn btn-danger">Button</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                        @if (count($data) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>League</th>
                                        <th>Home Team</th>
                                        <th>Away Team</th>
                                        <th>Result One</th>
                                        <th>Result Two</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value)
                                        {{-- <tr>
                                            <td width="10%">{{ $loop->iteration }}</td>
                                            <td width="70%">{{ $value->name }}</td>
                                            <td width="20%">
                                                <a href="{{ route('edit-league', $value->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ route('delete-league', $value->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->league->name }}</td>
                                            <td>{{ $value->home_team }}</td>
                                            <td>{{ $value->away_team }}</td>
                                            <td>{{ $value->result_one }}</td>
                                            <td>{{ $value->result_two }}</td>
                                            <td>
                                                <a href="{{ route('result.edit', $value->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ route('result.delete', $value->id) }}"
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
