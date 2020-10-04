<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FieldType;
use Auth;
use Redirect;

class FieldTypesController extends Controller
{

    public function show()
    {

        return FieldType::all();
        
    }

}
