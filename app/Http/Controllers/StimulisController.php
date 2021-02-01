<?php

namespace App\Http\Controllers;

use App\AnswerField;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\StimuliList;
use App\Stimuli;
use Carbon\Carbon;
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

        $list =  StimuliList::with("stimulis")->find($request->data['list_info']['id']);
        //GET STIMULI TYPE ID THAT'S SUPPOSE TO BE COMMON FOR A LIST
        $stimuli_type_id = !empty(count($list->stimulis()->pluck("stimuli_type_id"))) ?$list->stimulis()->pluck("stimuli_type_id")[0] : null;//TAKING FIRST VALUE
        //OTHERWISE GET A FIRST VALUE FROM STIMULI TYPES TABLE (CURRENTLY HARD CODING IT TO 1)
        if(empty($stimuli_type_id)){
            $stimuli_type_id = 1;
        }

        $answerField = AnswerField::where("field_type_id",1)->first();

        if($list) {
            $list->list_name = $request->data['list_info']['list_name'];
            $list->list_description = $request->data['list_info']['list_description'];
            $list->stimuli_per_page = $request->data['list_info']['stimuli_per_page'];
            $list->is_public = $request->data['list_info']['is_public'];
            $list->save();
        }

        //SELECT EACH ROW FROM ARRAY AND INSERT OR UPDATE IT
        foreach($stimuli as $s){

            $id = !empty($s["answerField"]) ? $s["answerField"]["pivot"]["stimuli_id"] : 0;
            if($id ===0){
                $s["stimuli_type_id"] = $stimuli_type_id;
                $record = auth()->user()->stimuli()->create($s);
                $list->stimulis()->attach($record, ['order' => '0',"created_at"=>Carbon::now()]);
                $record->answerField()->attach($answerField,["created_at"=>Carbon::now()]);

            }else{
                $stimuli = Stimuli::findOrFail($s["id"]);
                $stimuli->fill($s);
                $stimuli->save();
            }


            //
        }


        //DELETING THE RECODE (FIX WE SHOULD UPDATE THE SAME RECORD INSTEAD OF DELETING AND RECREATING)
        auth()->user()->stimuli()->whereIn('id', $request->data['toDelete'])->delete();




        $updatedStimuli = $list->stimulis()->get();

        return $updatedStimuli;


    }

    public function update(Request $request, $list_id)
    {

    }


    public function destroy(Request $request){
        $id= $request->data["id"];
        $stimuli = Stimuli::find($id);
            if($stimuli){
                $d = Stimuli::destroy($id);
                return response()->json(["status"=>true,"count"=>$d]);
            }


    }

}
