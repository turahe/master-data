<?php


namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\Currency\CurrencyStoreRequest;
use Turahe\Master\Http\Requests\Currency\CurrencyUpdateRequest;
use Turahe\Master\Models\Currency;

class CurrencyController extends Controller
{
    public function index(): View
    {
        $currencies = Currency::all();
        return view('master::currencies.index', compact('currencies'));
    }
    public function create(): View
    {
        return view('master::currencies.create');
    }
    public function store(CurrencyStoreRequest $request): RedirectResponse
    {
        Currency::create($request->all());
        return redirect()
            ->route('currencies.index')
            ->with('success', 'Color was saved');
    }
    public function edit(Currency $currency)
    {
        return view('master::currencies.create', compact('Color'));
    }
    public function update(CurrencyUpdateRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update($request->all());
        return redirect()
            ->route('currencies.index')
            ->with('success', 'Color was update');
    }
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()
            ->route('master::currencies.index')
            ->with('success', 'Currency deleted');
    }
}
