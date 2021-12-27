<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Image;
use App\Models\Issue;
use App\Models\IssueComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
     * @return Response
     */
    public function create(): Response
    {
        if(Auth::user() == null) {
            $canAccessDashboard = false;
        } else {
            if(Auth::user()->can('access_dashboard')) {
                $canAccessDashboard = true;
            } else {
                $canAccessDashboard = false;
            }
        }

        return Inertia::render('Issues/Report', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'dashboardAccess' => $canAccessDashboard,
            'categories' => Category::all()->toArray(),
            'cities' => City::all()->toArray(),
            'districts' => District::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $issue = Issue::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images', 'public');
        }

        Image::create([
            'issue_id' => $issue->id,
            'name' => str_replace('images/', '',$image_path),
        ]);

        return redirect(\route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        if(Auth::user() == null) {
            $canAccessDashboard = false;
        } else {
            if(Auth::user()->can('access_dashboard')) {
                $canAccessDashboard = true;
            } else {
                $canAccessDashboard = false;
            }
        }

        $issue = Issue::find($id);
        $issue->city_name = $issue->city->name;
        $issue->district_name = $issue->district->name;
        $issue->category_name = $issue->category->name;
        $issue->user_username = $issue->user->username;
        $issue->num_comments = $issue->comments->count();
        $issue->all_comments = $issue->comments;
        $issue->image = $issue->images->first()->name;

        foreach ($issue->all_comments as $comment) {
            $comment->username = $comment->user->username;
            $comment->avatar = $comment->user->profile_photo_url;
        }

        return Inertia::render('Issues/Show', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'dashboardAccess' => $canAccessDashboard,
            'issue' => $issue,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function comment(Request $request): RedirectResponse
    {
        $request->validate([
            'issue_id' => 'required',
            'comment' => 'required',
        ]);

        IssueComment::create([
            'issue_id' => $request->issue_id,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return back();
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
        Issue::find($id)->delete();
        return back();
    }
}
