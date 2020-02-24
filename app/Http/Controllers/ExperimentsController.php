<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Experiment;

class ExperimentsController extends Controller
{
    public function show($experimentID)
    {
        $experiment = Experiment::find($experimentID);

        return view('experiment',[
            'experiment'=> $experiment,
        ]);
    }
}
