<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function goToGallery()
    {
        $current_view = view("gallery")->with("lang", Session::get("language"));
        $dl = new DataLayer();

        // Sets initial home view
        if (Session::has("logged")) {
            $current_view =  $current_view->with("logged", true)
                ->with("loggedName", Session::get("loggedName"))
                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        } else {
            $current_view =  $current_view->with("logged", false);
        }

        // If present translates and adds the alert message
        if (Session::has("alert")) {
            $current_view = $current_view->with("alert", __(Session::pull("alert")));
        }

        if (Session::has("confirm")) {
            $current_view = $current_view->with("confirm", Session::pull("confirm"));
        }

        // Retrieve carousel images
        $carousel = $dl->latestImages(5);
        $current_view->with("carousel", $carousel);

        return $current_view;
    }

    public function upload(Request $request)
    {
        $file = $request->file('img');
        $destinationPath = public_path() . '/img/gallery';

        $name = $file->getClientOriginalName();

        $arrFiles = scandir($destinationPath);
        foreach ($arrFiles as $singleFile) {
            if (strtolower($name) == strtolower($singleFile)) {
                Session::put("alert", $name . " - " . __("A file with that name is already present!"));
                return redirect()->back();
            }
        }

        //Move Uploaded File
        $file->move($destinationPath, $name);
    }
}
