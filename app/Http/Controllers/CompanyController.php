<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index() {
        $companies = Company::with('locality')->filter()->get();



        return view('companies', compact('companies'));
    }

    public function create(Request $req) {
        $body = $req->all();

        $data = $req->validate([
            'name' => 'required|string|max:255',
            'cif' => 'required',
            'locality_id' => 'required'
        ]);

        $company = new Company();
        $company->fill($body);
       


        $company->save();

        return response('Company added', 200);
    }

    public function read(Company $company) {

        return view('companies.single', ['company' => $company]);

    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cif' => 'required',
            'locality_id' => 'required'
        ]);

        $company->update($data);

        return redirect()->route('companies');
    }

    public function destroy(Company $company) {
        $company->delete();
    }
}
