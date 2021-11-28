<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $allIssues = Issue::all()->count();
        $resolvedIssues = Issue::where('status', 0)->count();
        $resolveRate = ($resolvedIssues/$allIssues) * 100;

        return Inertia::render('Admin/Dashboard', [
            'reported_issues' => $allIssues,
            'resolve_rate' => $resolveRate,
            'user_registrations' => User::all()->count()
        ]);
    }
}
