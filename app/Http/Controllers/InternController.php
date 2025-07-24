<?php

namespace App\Http\Controllers;
use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $interns = Intern::all();
        return view('interns.index', compact('interns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('interns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'field' => 'required', // New field for specialization
            'join_date' => 'required|date',
            'leave_date' => 'nullable|date|after_or_equal:join_date',
        ]);

        Intern::create($request->all());

        return redirect()->route('interns.index')->with('success', 'Intern added successfully!');
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
         $intern = Intern::findOrFail($id);
    return view('interns.edit', compact('intern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'field' => 'required', // New field for specialization
            'join_date' => 'required|date',
            'leave_date' => 'nullable|date|after_or_equal:join_date',
        ]);

        $intern = Intern::findOrFail($id);
        $intern->update($request->all());

        return redirect()->route('interns.index')->with('success', 'Intern updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
