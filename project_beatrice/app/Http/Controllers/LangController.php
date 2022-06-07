<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller {
    
    public function changeLanguage(Request $request, $language) {
        if (! in_array($language, ['en', 'it'])) {
            abort(400);
        }

        Session::put("language", $language);

        return redirect()->back();
    }
}
