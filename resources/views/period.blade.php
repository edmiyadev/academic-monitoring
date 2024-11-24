@extends('layouts.app')

@section('content')
    @include('navigation')
    <section class="bg-white h-screen">
        @livewire('period-subjects', ['periodId' => $periodId])
    </section>
@endsection
