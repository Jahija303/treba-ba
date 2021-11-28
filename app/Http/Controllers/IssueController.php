<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit_issue')->only(['update']);
        $this->middleware('can:delete_issue')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $issues = Issue::paginate(15);
        foreach ($issues as $issue) {
            $issue->city_name = $issue->city->name;
            $issue->district_name = $issue->district->name;
            $issue->category_name = $issue->category->name;
            $issue->user_username = $issue->user->username;
        }

        return Inertia::render('Admin/Issues/Index', [
            'issues' => $issues,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Issue $issue
     * @return RedirectResponse
     */
    public function update(Request $request,$id): RedirectResponse
    {
        $request->validate([
            'status' => 'required',
        ]);

        $issue = Issue::find($id);
        $issue->update([
            'status' => $request->status,
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $issue = Issue::find($id);
        $issue->delete();
        return back();
    }
}
