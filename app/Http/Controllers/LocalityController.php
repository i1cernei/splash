<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locality;

class LocalityController extends Controller
{
    //
    public function index(Locality $locality) {
        $companies = $locality->companies;

        return view('companies', compact('companies'));
    }
}
