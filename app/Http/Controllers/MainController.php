<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function renderDashboard(Request $request)
    {
        return Inertia::render('Dashboard')->with([
            // 'user' => User::find($request->user()->id)
            'user' => $request -> user()
        ]);
    }
}
