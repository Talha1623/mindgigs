<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $today = now()->toDateString();

    $todayVisitorsCount = Visitor::whereDate('created_at', $today)->count();

    $todayDealsCount = Visitor::whereDate('created_at', $today)
        ->whereIn('status', ['Enrolled', 'Interested', 'Follow Up'])
        ->count();

    return view('dashboard', [
        'todayVisitorsCount' => $todayVisitorsCount,
        'todayDealsCount' => $todayDealsCount
    ]);
}

public function projects(){
    return view('projects.index');
}

}
