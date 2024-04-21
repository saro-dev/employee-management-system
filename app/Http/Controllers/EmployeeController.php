<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::orderBy('id','asc')->paginate(3);

        return view("index",compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'joining_date' => 'required|date',
        'joining_salary' => 'required|numeric|min:0',
        'is_active' => 'nullable|boolean',
    ]);

    // Create a new employee instance
    $employee = new Employees();

    // Assign validated data to the employee instance
    $employee->name = $validatedData['name'];
    $employee->email = $validatedData['email'];
    $employee->joining_date = $validatedData['joining_date'];
    $employee->joining_salary = $validatedData['joining_salary'];
    $employee->is_active = $validatedData['is_active'] ?? false; // Default to false if not provided

    // Save the employee record
    $employee->save();

    // Redirect back with a success message
    return redirect('/employees')->with('success', 'Employee created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employees::find($id);
        return view('show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employees::find($id);
        return view('edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employees::find($id);

         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:employees,email,'.$employee->id.'|email',
            'joining_date' => 'required|date',
            'joining_salary' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $employee = Employees::find($id);
        $employee->update($data);
        return redirect()->route('employees.edit',$employee->id)->withsuccess("Succesfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::find($id);
        $employee->delete();
        return redirect()->route("employees.index")->withsucess("Employee deleted succesfully");
    }
}
