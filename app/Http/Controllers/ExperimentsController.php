<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Experiment;

class ExperimentsController extends Controller
{
    public function show($experiment_id)
    {
        
        $experiment = Experiment::find($experiment_id);
        
        // Only authorize if user is the owner of experiment or experiment is public.
        // Check ExperimentPolicy.php
        $this->authorize('view', $experiment);

        return view('experiment', compact('experiment'));
    }

    public function edit($experiment_id)
    {
        
        $experiment = Experiment::find($experiment_id);
        
        // Only authorize if user is the owner of experiment.
        // Check ExperimentPolicy.php
        $this->authorize('update', $experiment);

        return view('experiments.edit', compact('experiment'));
    }

    public function create()
    {
        return view('experiments.create');
    }

    public function store()
    {
        $data = request()->validate([
            'experiment_name' => 'required',
            'welcome_text' => '',
            'consent_text' => '',
            'consent_label' => '',
            'instructions_text' => '',
            'ending_text' => '',
            'is_public' => ''
        ]);

        $data['is_active'] = 1;
        
        auth()->user()->experiment()->create($data);
        
        return redirect('/home');

    }


}
