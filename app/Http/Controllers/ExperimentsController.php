<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Experiment;
use App\StimuliList;
use App\Stimuli;
use App\AnswerField;
use App\ListInExperiment;
use App\CustomClass\ListWithStimuli;
use Redirect;

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
        $stimuli_lists_raw =  $experiment->stimuli_lists()->get();
        $stimuli_lists = array();

        foreach($stimuli_lists_raw as $list) {

            $listWithStimuli = new ListWithStimuli;
            $listWithStimuli->list_info = $list;
            $listWithStimuli->stimuli = $list->stimulis()->get();

            foreach($listWithStimuli->stimuli as $stimuli) {

                $theStimuli = Stimuli::find($stimuli->id);
                if(count($stimuli->answerField)>0){
                    $stimuli->answerField = $theStimuli->answerField()->get()->first();
                    $stimuli->answerField->options = json_decode($stimuli->answerField->options);
                }

            }

            array_push($stimuli_lists, $listWithStimuli);
        }


        // Only authorize if user is the owner of experiment.
        // Check ExperimentPolicy.php
        $this->authorize('update', $experiment);

        return view('experiments.edit', compact('experiment','stimuli_lists'));
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

        $data['is_active'] = '1';

        auth()->user()->experiment()->create($data);

        return redirect('/home');

    }

    public function update(USER $user, $experiment_id)
    {

        $data = request()->validate([
            'experiment_name' => 'required',
            'welcome_text' => '',
            'consent_text' => '',
            'consent_label' => '',
            'instructions_text' => '',
            'ending_text' => '',
            'is_public' => '',
            'is_active' => ''
        ]);


        $exp = Experiment::find($experiment_id);

        foreach($data as $key => $value)
        {
            $exp[$key] = $value;
        };

        $exp->save();

        return Redirect::back()->with('message','Changes saved successfully');
    }


}
