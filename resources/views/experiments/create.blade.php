@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row col-md-6 offset-4 mb-4">
        <h1>Create new experiment</h1>
    </div>

    <form action="/experiment" method="post">
        @csrf
        <div class="form-group row">  
    
            <label for="experiment_name" class="col-md-4 col-form-label text-md-right">Title of the experiment *</label>

            <div class="col-md-6">
                <input 
                id="experiment_name" 
                type="text" 
                class="form-control @error('experiment_name') is-invalid @enderror" 
                name="experiment_name" 
                
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
                >
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
                >
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
                >
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
                >
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

            <div class="col-md-6"> 
                <input 
                class="@error('is_public') is-invalid @enderror" 
                type="checkbox" 
                id="is_public" 
                name="is_public" 
                value="1">
            </div>

        </div>

        <div class="row col-md-4 offset-4">
            <button class="btn btn-primary">Create</button>
        </div>

    </form>


</div>
@endsection