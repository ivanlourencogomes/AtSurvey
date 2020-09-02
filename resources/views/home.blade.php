@extends('layouts.app')

@section('content')
<div class="container">
    
    <a href="/experiment/create">
        <button type="button">New experiment</button>
    </a>


    <section class="experiments mt-4 mb-4 p-2">
        
        @foreach ($experiments as $experiment)
        <a href="/experiment/{{$experiment->id}}/edit">
        {{$experiment->experiment_name}}
        </a>
        <br>
        @endforeach

    </section>

</div>
@endsection
