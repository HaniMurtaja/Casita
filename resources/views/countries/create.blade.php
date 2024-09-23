@extends('layouts.app')

@section('content')
    <h1>Create Country</h1>
    <form action="{{ route('countries.store') }}" method="POST">
        @csrf
        <label>Name (EN):</label>
        <input type="text" name="name_en">
        <label>Name (AR):</label>
        <input type="text" name="name_ar">
        <label>Description (EN):</label>
        <textarea name="description_en"></textarea>
        <label>Description (AR):</label>
        <textarea name="description_ar"></textarea>
        <button type="submit">Create</button>
    </form>
@endsection
