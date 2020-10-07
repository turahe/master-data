<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\City\CityStoreRequest;
use Turahe\Master\Http\Requests\City\CityUpdateUpdate;
use Turahe\Master\Models\City;

/**
 * Class CityController
 * @package Turahe\Master\Http\Controllers
 */
class CityController extends Controller
{
    /**
     * @return mixed
     */
    public function index(): View
    {
        $data = City::with('provinces')
            ->autoSort()
            ->autoFilter()
            ->search(request('search'))->paginate();

        return view('master::cities.index', compact('data'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('master::cities.create');
    }

    /**
     * @param CityStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CityStoreRequest $request): RedirectResponse
    {
        City::create($request->validated());

        return redirect()
            ->route('master::cities.index')
            ->with('success', 'City saved');
    }

    /**
     * @param City $city
     * @return View
     */
    public function edit(City $city): View
    {
        return view('master::cities.edit', compact('city'));
    }

    /**
     * @param CityUpdateUpdate $request
     * @param City $city
     * @return RedirectResponse
     */
    public function update(CityUpdateUpdate $request, City $city): RedirectResponse
    {
        $city->update($request->validated());

        return redirect()
            ->route('master::cities.edit', $city)
            ->with('success', 'City saved');
    }

    /**
     * @param City $city
     * @throws \Exception
     * @return RedirectResponse
     */
    public function destroy(City $city): RedirectResponse
    {
        try {
            $city->delete();

            return redirect()->route('master::cities.index')->with('success', 'City deleted');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
