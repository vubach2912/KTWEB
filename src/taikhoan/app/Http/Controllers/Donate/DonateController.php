<?php

namespace App\Http\Controllers\Donate;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    //
    public function getDonate(){
        if(Auth::user()->name){
            $usename = Auth::user()->name;
        }
        $data['username'] = $usename;
        return view('donate.index' , $data);
    }
}
