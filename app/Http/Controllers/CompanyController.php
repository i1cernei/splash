<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    //
    public function index() {
        $companies = Company::with('locality')
        ->latest()
        ->filter(request(['search']))
        ->paginate();



        return view('companies',['companies' => $companies]);
    }

    public function create() {

        return view('companies.create');
    }

    public function store() {
        // dd(request()->all());
        
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'cif' => ['required', Rule::unique('companies', 'cif')],
            'locality_id' => ['required', Rule::exists('localities', 'id')],
            'region' => ['required', Rule::exists('regions', 'id')],
            'description' => 'nullable',
        ]);

        // dd($data);

        $company = Company::create([
            'name' => $data['name'],
            'cif' => $data['cif'],
            'locality_id' => $data['locality_id'],
            'description' => $data['description']
        ]);

        return redirect('/companies');
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
