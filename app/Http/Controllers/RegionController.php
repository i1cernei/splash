<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Region;

class RegionController extends Controller
{
    //

        public function index(Region $region) {

            // DB::listen( function ($query) {
            //     logger($query->sql);
            // });
        
        $companies = $region->companies()->paginate(15);

        return view('companies', compact('companies'));
    }

    public function localities(Region $region) {
        return $region->localities;
    }
}
