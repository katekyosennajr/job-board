@extends('layouts.app')

@section('content')
<div>
    <h2>Pending Job Posts</h2>

    @foreach($jobs as $job)
        <div style="padding: 12px; border: 1px solid #ddd; margin-bottom: 10px;">
            <h4>{{ $job->title }}</h4>
            <p>{{ $job->description }}</p>

            <form method="POST" action="{{ route('admin.jobs.approve', $job->id) }}">
                @csrf
                <button type="submit">Terima</button>
            </form>

            <form method="POST" action="{{ route('admin.jobs.reject', $job->id) }}">
                @csrf
                <button type="submit">Tolak</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
