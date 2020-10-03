<?php

namespace Turahe\Address\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Address\Http\Requests\Province\ProvinceStoreRequest;
use Turahe\Address\Http\Requests\Province\ProvinceUpdateRequest;
use Turahe\Address\Models\Province;

/**
 * Class ProvinceController
 * @package Turahe\Address\Http\Controllers
 */
class ProvinceController extends Controller
{
    /**
     * @return mixed
     */
    public function index(): View
    {
        $provinces = Province::autoSort()->autoFilter()->search(request('search'))->paginate();

        return  view('address::provinces.index', compact('provinces'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('address::provinces.create');
    }

    /**
     * @param ProvinceStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProvinceStoreRequest $request): RedirectResponse
    {
        Province::create($request->validated());

        return redirect()
            ->route('address::provinces.index')
            ->with('success', 'Province saved');
    }

    /**
     * @param Province $province
     * @return View
     */
    public function edit(Province $province): View
    {
        return view('address::provinces.edit', compact('province'));
    }

    /**
     * @param ProvinceUpdateRequest $request
     * @param Province $province
     * @return RedirectResponse
     */
    public function update(ProvinceUpdateRequest $request, Province $province): RedirectResponse
    {
        $province->update($request->validated());

        return redirect()
            ->route('address::provinces.edit', $province)
            ->with('success', 'Province saved');
    }

    /**
     * @param Province $province
     * @throws \Exception
     * @return RedirectResponse
     */
    public function destroy(Province $province): RedirectResponse
    {
        try {
            $province->delete();

            return redirect()
                ->route('address::provinces.index')
                ->with('success', 'Province deleted');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
