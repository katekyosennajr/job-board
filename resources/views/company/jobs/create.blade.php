@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('company.jobs.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Job Title">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Pos</button>
</form>
@endsection
