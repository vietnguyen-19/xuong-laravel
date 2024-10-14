<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::query()->latest()->paginate(5);

        return view('employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::all();
        $manager = Manager::all();

        return view('employees.create', compact('department', 'manager'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('employees')],
            'phone' => 'required|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'is_active' => ['nullable', Rule::in([0, 1])],
            'department_id' => 'required|integer',
            'manager_id' => 'required|integer',
            'address' => 'required',
        ]);

        try {

            if ($request->hasFile('profile_picture')) {

                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            }

            Employee::query()->create($data);

            return redirect()->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $department = Department::all();
        $manager = Manager::all();

        return view('employees.edit', compact('employee', 'department', 'manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('employees')->ignore($employee->id)],
            'phone' => 'required|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'is_active' => ['nullable', Rule::in([0, 1])],
            'department_id' => 'required|integer',
            'manager_id' => 'required|integer',
            'address' => 'required',
        ]);

        $data['is_active'] = isset($data['is_active']) ?? 0;

        try {

            if ($request->hasFile('profile_picture')) {

                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            }
            $currentAvatar = $employee->avatar;

            $employee->update($data);

            if ($request->hasFile('profile_picture') && !empty($currentAvatar) && Storage::exists($currentAvatar)) {
                Storage::delete($data['profile_picture']);
            }

            return back()->with('success', true);

        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return back()->with('success', true);

        } catch (\Throwable $th) {
            return back()->with('success', false)
            ->with('error', $th->getMessage());
        }
    }
}
