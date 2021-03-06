<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:add_district')->only(['store']);
        $this->middleware('can:edit_district')->only(['update']);
        $this->middleware('can:delete_district')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $districts = District::paginate(15);

        foreach ($districts as $district) {
            $district->city_name = $district->city->name;
        }

        return Inertia::render('Admin/Districts/Index', [
            'districts' => $districts,
            'cities' => City::all()->toArray()
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
            'name' => 'required|unique:districts',
            'description' => 'required|unique:districts',
            'city_id' => 'required'
        ]);

        District::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1,
            'city_id' => $request->city_id
        ]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:districts',
            'description' => 'required',
            'city_id' => 'required'
        ]);

        $district = District::find($id);
        $district->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1,
            'city_id' => $request->city_id
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
        $district = District::find($id);
        $district->delete();
        return back();
    }
}
