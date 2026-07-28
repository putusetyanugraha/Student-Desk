<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguangeController extends Controller
{
    public function switch($locale){
        $supportedlang = ["id", "en"];

        if(in_array($locale, $supportedlang)){
            session(["locale" => $locale]);
        }

        return redirect()->back();
    }
}
