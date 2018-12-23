<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    private function getFunctionData(){
        $getUser = \Auth::user();
        $data['user'] = $getUser?str_replace(' ','_',strtolower($getUser->name)):'user';
        $data['path'] = '/home/search '.($getUser?'#':'$');
        return $data;
    }
}
