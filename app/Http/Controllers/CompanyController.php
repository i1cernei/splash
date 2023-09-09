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

    public function edit(Company $company) {

        return view('companies.edit', ['company' => $company]);
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

        return redirect('/companies')->with('success', 'Company added!');
    }

    public function read(Company $company) {

        return view('companies.single', ['company' => $company]);

    }

    public function update( Company $company)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'cif' => ['required', Rule::unique('companies', 'cif')->ignore($company->id)],
            'locality_id' => ['required', Rule::exists('localities', 'id')],
            'region' => ['required', Rule::exists('regions', 'id')],
            'description' => 'nullable',
        ]);

        $company->update($data);

        return back()->with('success','Company updated!');
    }

    public function destroy(Company $company) {
        $company->delete();

        return back()->with('success', 'Company deleted!');
    }
}
