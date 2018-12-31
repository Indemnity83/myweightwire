@extends('layouts.app')

@section('body')
    <div class="w-full">
        <div class="bg-white shadow-md rounded">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Competitors</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competitions as $competition)
                <tr>
                    <th scope="row">{{ $competition->id }}</th>
                    <td><a href="{{ route('competitions.show', $competition) }}">{{ $competition->name }}</a></td>
                    <td>{{ count($competition->users) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
