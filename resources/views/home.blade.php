@extends('layouts.app')

@section('content')
<div class="container">
    
    <a href="/experiment/create">
        <button type="button" class="btn btn-primary">New experiment</button>
    </a>


    <section class="experiments mt-4 mb-4 p-2">
    
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Last modified</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($experiments as $experiment)
               
                    <tr>
                        <td>  
                            <a href="/experiment/{{$experiment->id}}/edit">
                                {{$experiment->experiment_name}}
                            </a>
                        </td>
                        <td> {{$experiment->updated_at}}</td>
                        <td class="action-cell" data-exp="{{$experiment->id}}"> 
                            <a href="#">duplicate</a> | <a  href="#">delete</a> 
                        </td>
                    </tr>
                
            @endforeach
            
        </tbody>
    </table>

        

    </section>

</div>
@endsection
