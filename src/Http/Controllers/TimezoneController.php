<?php


namespace Turahe\Master\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\Timezone\TimezoneStoreRequest;
use Turahe\Master\Http\Requests\Timezone\TimezoneUpdateRequest;
use Turahe\Master\Models\Timezone;

class TimezoneController extends Controller
{
    public function index(): View
    {
        $timezones = Timezone::all();
        return view('master::timezones.index', compact('timezones'));
    }
    public function create(): View
    {
        return view('master::timezones.create');
    }
    public function store(TimezoneStoreRequest $request): RedirectResponse
    {
        Timezone::create($request->all());
        return redirect()
            ->route('timezones.index')
            ->with('success', 'Color was saved');
    }
    public function edit(Timezone $timezone)
    {
        return view('master::timezones.create', compact('timezone'));
    }
    public function update(TimezoneUpdateRequest $request, Timezone $timezone): RedirectResponse
    {
        $timezone->update($request->all());
        return redirect()
            ->route('timezones.index')
            ->with('success', 'Color was update');
    }
    public function destroy(Timezone $timezone)
    {
        $timezone->delete();

        return redirect()
            ->route('master::timezones.index')
            ->with('success', 'Timezone deleted');
    }

}
