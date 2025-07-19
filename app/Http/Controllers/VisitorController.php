<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    
    public function index()
{
    

     $visitors = Visitor::whereDate('created_at', now())->with('addedBy')->get();    $users = User::all(); // <-- get all registered users
    return view('visitors.index', compact('visitors', 'users'));
    
}

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'contact' => 'required',
        'source' => 'required',
    ]);

    Visitor::create([
        'name' => $request->name,
        'contact' => $request->contact,
        'email' => $request->email,
        'source' => $request->source,
        'purpose' => $request->purpose,
        'person_to_meet' => $request->person_to_meet,
        'added_by' => auth()->id(), // <- track user who added
    ]);

    return redirect()->back()->with('success', 'Visitor added successfully!');
}
    public function create()
{
     $users = User::all(); // ya ->where('role', 'staff') agar role based filter chahiye
    return view('visitors.create', compact('users'));
   
}

    public function edit($id)
{
    $visitor = Visitor::findOrFail($id);
    return view('visitors.edit', compact('visitor'));
}

    public function update(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->update($request->all());

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully!');
    }

    public function destroy($id)
    {
        Visitor::destroy($id);
        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully!');
    }
  
    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitors.show', compact('visitor'));
    }
public function todayDeals()
{
    $today = now()->toDateString(); // timezone fix ho chuka hai agar config sahi hai
    $visitors = Visitor::whereDate('created_at', $today)
        ->with('addedBy')
        ->latest()
        ->get();

    $totalVisitors = $visitors->count(); // ✅ count nikal liya

    return view('visitors.today-deals', compact('visitors', 'totalVisitors'));
}



    
}
