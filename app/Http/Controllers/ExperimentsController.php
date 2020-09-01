<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Experiment;

class ExperimentsController extends Controller
{
    public function show($experiment_id)
    {
        
        $experiment = Experiment::find($experiment_id);
        
        // Only authorize if user is the owner of experiment or experiment is public.
        // Check ExperimentPolicy.php
        $this->authorize('view', $experiment);

        return view('experiment',[
            'experiment'=> $experiment,
        ]);
    }
}
