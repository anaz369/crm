<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Models\Company;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $companies = Company::paginate(10);

            return response()->json($companies);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( CompanyFormRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $company = new Company();
            $company->name = $validatedData['name'];
            $company->email = $validatedData['email'];
            $company->website = $validatedData['website'];

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $logo->store('public/logos');
                $company->logo = Storage::url($logoPath);
            }

            $company->save();

            return response()->json(['message' => 'Company created successfully']);
        } catch (ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()], 422);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to create company'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $company = Company::find($id);
            return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyFormRequest $request, string $id)
    {
        $company = Company::find($id);

        $validatedData = $request->validated();

        $company->Name = $validatedData['name'];
        $company->email = $validatedData['email'];
        $company->website = $validatedData['website'];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            $logoPath = $logo->store('public/logos');
            $company->logo = Storage::url($logoPath);
        }

        $company->save();
        return response()->json(['message' => 'Company updated successfully','companu'=>$company]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $company = Company::find($id);
            $company->delete();
            return response()->json(['message' => 'Company deleted successfully']);

    }
}
