@extends('master')

@section('content')
    <div class="container mt-4">
        <h2>{{ $header }}</h2>
        @include('partials.success-alert')
        <div class="row">
            @forelse($adoptions as $adoption)
                <div class="col-4 pet">
                    @include('adoptions.partials.card', ['adoption' => $adoption])
                </div>
            @empty
                <h2>This list is empty</h2>
                @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
            @endforelse
        </div>
    </div>
@endsection
