<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFormRequest;
use App\Models\Company;
use App\Models\Employee;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);

         return response()->json($employees);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeFormRequest $request)
    {
       try{ $validatedData = $request->validated();

        $employee = Employee::create($validatedData);

        return response()->json(['message' => 'Employee created successfully', 'data' => $employee], 201);

    } catch (ValidationException $exception) {
        return response()->json(['errors' => $exception->errors()], 422);
    } catch (\Exception $exception) {
        return response()->json(['message' => 'Failed to create company'], 500);
    }
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
        $employee = Employee::find($id);

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeFormRequest $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->First_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->companyId = $request->input('companyId');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');

        $employee->save();

        return response()->json(['message' => 'Employee updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Employee::find($id);
        $company->delete();
        return response()->json(['message' => 'employee deleted successfully']);
    }
}
