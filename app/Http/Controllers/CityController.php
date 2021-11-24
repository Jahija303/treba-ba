<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $cities = City::paginate(15);

        return Inertia::render('Admin/Cities/Index', [
            'cities' => $cities
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
            'name' => 'required|unique:cities',
            'description' => 'required|unique:cities',
            'population' => 'required',
        ]);

        City::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1,
            'population' => $request->population
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
            'name' => 'required',
            'description' => 'required',
            'population' => 'required',
        ]);

        $city = City::find($id);
        $city->update($request->all());

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
        $city = City::find($id);
        $city->delete();
        return back();
    }
}
