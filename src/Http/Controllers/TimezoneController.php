<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\Timezone\TimezoneStoreRequest;
use Turahe\Master\Http\Requests\Timezone\TimezoneUpdateRequest;
use Turahe\Master\Models\Timezone;

/**
 * Class TimezoneController.
 */
class TimezoneController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $timezones = Timezone::all();

        return view('master::timezones.index', compact('timezones'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('master::timezones.create');
    }

    /**
     * @param TimezoneStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(TimezoneStoreRequest $request): RedirectResponse
    {
        Timezone::create($request->all());

        return redirect()
            ->route('timezones.index')
            ->with('success', 'Color was saved');
    }

    /**
     * @param Timezone $timezone
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(Timezone $timezone)
    {
        return view('master::timezones.create', compact('timezone'));
    }

    /**
     * @param TimezoneUpdateRequest $request
     * @param Timezone              $timezone
     *
     * @return RedirectResponse
     */
    public function update(TimezoneUpdateRequest $request, Timezone $timezone): RedirectResponse
    {
        $timezone->update($request->all());

        return redirect()
            ->route('timezones.index')
            ->with('success', 'Color was update');
    }

    /**
     * @param Timezone $timezone
     *
     * @throws \Exception
     *
     * @return RedirectResponse
     */
    public function destroy(Timezone $timezone)
    {
        $timezone->delete();

        return redirect()
            ->route('master::timezones.index')
            ->with('success', 'Timezone deleted');
    }
}
