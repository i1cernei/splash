<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locality;

class LocalityController extends Controller
{
    //
    public function index(Locality $locality) {
        $companies = $locality->companies()
        ->filter(request(['search']))
        ->paginate(15);

        return view('companies', compact('companies'));
    }
}
