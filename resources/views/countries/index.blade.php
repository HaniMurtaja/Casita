@extends('layouts.app')

@section('content')
    <h1>Countries</h1>
    <a href="{{ route('countries.create') }}">Create Country</a>
    <table>
        <thead>
            <tr>
                <th>Name (EN)</th>
                <th>Name (AR)</th>
                <th>Description (EN)</th>
                <th>Description (AR)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->name_en }}</td>
                    <td>{{ $country->name_ar }}</td>
                    <td>{{ $country->description_en }}</td>
                    <td>{{ $country->description_ar }}</td>
                    <td>
                        <a href="{{ route('countries.edit', $country->id) }}">Edit</a>
                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('countries.logs') }}">View Logs</a>
@endsection
