<?php


namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\Color\ColorStoreRequest;
use Turahe\Master\Http\Requests\Color\ColorUpdateRequest;
use Turahe\Master\Models\Color;

class ColorController extends Controller
{
    public function index(): View
    {
        $colors = Color::all();
        return view('master::colors.index', compact('colors'));
    }
    public function create(): View
    {
        return view('master::colors.create');
    }
    public function store(ColorStoreRequest $request): RedirectResponse
    {
        Color::create($request->all());
        return redirect()
            ->route('colors.index')
            ->with('success', 'Color was saved');
    }
    public function edit(Color $color)
    {
        return view('master::colors.create', compact('color'));
    }
    public function update(ColorUpdateRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->all());
        return redirect()
            ->route('colors.index')
            ->with('success', 'Color was update');
    }
    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()
            ->route('master::colors.index')
            ->with('success', 'Color deleted');
    }
}
