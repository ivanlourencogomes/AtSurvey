@extends('layouts.app')

@section('content')
<div class="container">
   
    <button type="button">New experiment</button>


    <section class="experiments mt-4 mb-4 p-2">
        
        @foreach ($experiments as $experiment)
        <a href="/experiment/{{$experiment->id}}">
        {{$experiment->experiment_name}}
        </a>
        <br>
        @endforeach

    </section>

</div>
@endsection
