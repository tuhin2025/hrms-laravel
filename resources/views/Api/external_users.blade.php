@extends('layouts.app')

@section('content')

    <table class="table table-bordered">

        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
        </tr>
        </thead>

        <tbody>

        @foreach($users as $user)

            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['company']['name'] }}</td>
            </tr>

        @endforeach

        </tbody>

    </table>
@endsection
