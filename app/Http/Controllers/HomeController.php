<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $issues = Issue::all()->take(8);

        foreach ($issues as $issue) {
            $issue->numLikes = $issue->likes()->count();
            $issue->numComments = $issue->comments()->count();
        }

        if(Auth::user() == null) {
            $canAccessDashboard = false;
        } else {
            if(Auth::user()->can('access_dashboard')) {
                $canAccessDashboard = true;
            } else {
                $canAccessDashboard = false;
            }
        }

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'issues' => $issues,
            'dashboardAccess' => $canAccessDashboard
        ]);
    }
}
