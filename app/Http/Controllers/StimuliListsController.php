<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\StimuliList;
use Redirect;

class StimuliListsController extends Controller
{

    

    public function store()
    {
        // $data = request()->validate([
        //     'experiment_name' => 'required',
        //     'welcome_text' => '',
        //     'consent_text' => '',
        //     'consent_label' => '',
        //     'instructions_text' => '',
        //     'ending_text' => '',
        //     'is_public' => ''
        // ]);

        // $data['is_active'] = '1';
        
        // auth()->user()->experiment()->create($data);
        
        // return redirect('/home');

    }

    public function update(Request $request, $list_id)
    {
        return Redirect::back()->with('message','Changes saved successfully');
        dd($list_id);
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
