@extends('layouts.app')

@section('content')
    @include('navigation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('period-management')
        </div>
    </div>
@endsection
