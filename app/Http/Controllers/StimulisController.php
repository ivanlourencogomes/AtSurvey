<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\StimuliList;
use Redirect;

class StimulisController extends Controller
{

    public function store(Request $request)
    {
        $stimuli = $request->data['stimuli'];

        $validator = \Validator::make($stimuli, [
            'condition' => '',
            'condition_code' => '',
            'stimuli_text' => '',
            'item' => '',
            'item_id' => '',
            'trial' => '',
            'instruction_text' => '',
            'stimuli_type_id' => ''
        ]);
        
        if($validator->fails()) {
                    return $validator->errors();
        }
        
        $list =  StimuliList::find($request->data['list_info']['id']);
        
        auth()->user()->stimuli()->whereIn('id', $request->data['toDelete'])->delete();

        $records = auth()->user()->stimuli()->createMany($stimuli);

        $list->stimulis()->attach($records, ['order' => '0']);
        
        return 'success';

    }

    public function update(Request $request, $list_id)
    {
        
    }


}
