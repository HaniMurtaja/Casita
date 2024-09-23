@extends('layouts.app')

@section('content')
    <h1>Edit Country</h1>
    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name (EN):</label>
        <input type="text" name="name_en" value="{{ $country->name_en }}">
        <label>Name (AR):</label>
        <input type="text" name="name_ar" value="{{ $country->name_ar }}">
        <label>Description (EN):</label>
        <textarea name="description_en">{{ $country->description_en }}</textarea>
        <label>Description (AR):</label>
        <textarea name="description_ar">{{ $country->description_ar }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
