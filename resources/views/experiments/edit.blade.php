@extends('layouts.app')

@section('content')
<div class="container">
   
   @if(Session::get('message'))
    <div class="alert alert-success text-center" role="alert">
        {{Session::get('message')}}
    </div>
    @endif

    
    <div class="row">
        <a href="/home">
            <button type="button" class="btn btn-link">< Back to Experiments</button>
        </a>
    </div>

    <div class="row col-md-6 offset-4 mb-4">
        <h1>Edit experiment</h1>
    </div>

    


    <form action="/experiment/{{$experiment->id}}" method="post">
        @csrf
        @method('PATCH')

        <div class="form-group row">  
    
            <label for="experiment_name" class="col-md-4 col-form-label text-md-right">Title of the experiment *</label>

            <div class="col-md-6">
                <input 
                id="experiment_name" 
                type="text" 
                class="form-control @error('experiment_name') is-invalid @enderror" 
                name="experiment_name" 
                value="{{ old('experiment_name') ?? $experiment->experiment_name }}"
                autocomplete="experiment_name" 
                autofocus>

                @error('experiment_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label for="welcome_text" class="col-md-4 col-form-label text-md-right">Welcome text</label>

            <div class="col-md-6">
                <textarea 
                id="welcome_text"  
                class="form-control @error('welcome_text') is-invalid @enderror" 
                name="welcome_text"
                >{{ old('welcome_text') ?? $experiment->welcome_text }}
                </textarea>

                @error('welcome_text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="form-group row">

            <label for="consent_text" class="col-md-4 col-form-label text-md-right">Consent text</label>

            <div class="col-md-6">
                <textarea 
                id="consent_text"  
                class="form-control @error('consent_text') is-invalid @enderror" 
                name="consent_text"
                >{{ old('consent_text') ?? $experiment->consent_text }}
                </textarea>

                @error('consent_text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="form-group row">
            <label for="consent_label" class="col-md-4 col-form-label text-md-right">Consent label</label>

            <div class="col-md-6">
                <input 
                id="consent_label" 
                type="text" 
                class="form-control @error('consent_label') is-invalid @enderror" 
                name="consent_label" 
                placeholder="Ex: I agree"
                value="{{ old('consent_label') ?? $experiment->consent_label }}"
                >

                @error('consent_label')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="form-group row">

            <label for="instructions_text" class="col-md-4 col-form-label text-md-right">Instructions text</label>

            <div class="col-md-6">
                <textarea 
                id="instructions_text"  
                class="form-control @error('instructions_text') is-invalid @enderror" 
                name="instructions_text"
                >{{ old('instructions_text') ?? $experiment->instructions_text }}
                </textarea>

                @error('instructions_text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
        </div>

        <div class="form-group row">

            <label for="ending_text" class="col-md-4 col-form-label text-md-right">Ending text</label>

            <div class="col-md-6">
                <textarea 
                id="ending_text"  
                class="form-control @error('ending_text') is-invalid @enderror" 
                name="ending_text"
                >{{ old('ending_text') ?? $experiment->ending_text }}
                </textarea>

                @error('ending_text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label class="col-md-4 col-form-label text-md-right" for="is_public">Make this experiment public</label>
            <input type="hidden" value="0" name="is_public">
            <div class="col-md-6"> 
                <input 
                class="@error('is_public') is-invalid @enderror" 
                type="checkbox" 
                id="is_public" 
                name="is_public" 
                @if ($experiment->is_public)
                    checked
                @endif
                value="{{ old('is_public') ?? $experiment->is_public }}">
            </div>

        </div>

        <div class="form-group row">

            <label class="col-md-4 col-form-label text-md-right" for="is_active">Active</label>

            <input type="hidden" value="0" name="is_active">
            <div class="col-md-6"> 
                <input 
                class="@error('is_active') is-invalid @enderror" 
                type="checkbox" 
                id="is_active" 
                name="is_active"
                @if ($experiment->is_active)
                    checked
                @endif 
                value="{{ old('is_active') ?? $experiment->is_active }}">
            </div>

        </div>

        <div class="row col-md-4 offset-4">
            <button class="btn btn-primary">Save</button>
        </div>

    </form>

    <section class="stimuli_lists mt-4">
        <h2>Stimuli Lists</h2>
        <hr>
        
        <div>
            <stimuli-lists :lists="{{ json_encode($stimuli_lists) }}" />
            
        </div>
    </section>

</div>
@endsection