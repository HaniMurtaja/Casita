@extends('layouts.app')

@section('content')
    <h1>Logs</h1>
    <table>
        <thead>
            <tr>
                <th>Model Type</th>
                <th>Model ID</th>
                <th>Changes</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->model_type }}</td>
                    <td>{{ $log->model_id }}</td>
                    <td>{{ $log->changes }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
