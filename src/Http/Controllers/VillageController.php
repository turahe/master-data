<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Master\Http\Requests\Village\VillageStoreRequest;
use Turahe\Master\Http\Requests\Village\VillageUpdateRequest;
use Turahe\Master\Models\Village;

/**
 * Class VillageController
 * @package Turahe\Master\Http\Controllers
 */
class VillageController extends Controller
{
    /**
     * @return mixed
     */
    public function index(): View
    {
        $villages = Village::with('districts')
            ->autoSort()
            ->autoFilter()
            ->search(request('search'))->paginate();

        return view('master::villages.index', compact('villages'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('master::villages.create');
    }

    /**
     * @param VillageStoreRequest $request
     * @return mixed
     */
    public function store(VillageStoreRequest $request): RedirectResponse
    {
        Village::create($request->validated());

        return redirect()
            ->route('master::villages.index')
            ->with('success', 'Village saved');
    }

    /**
     * @param Village $village
     * @return View
     */
    public function edit(Village $village): View
    {
        return view('master::villages.edit', compact('village'));
    }

    /**
     * @param VillageUpdateRequest $request
     * @param Village $village
     * @return mixed
     */
    public function update(VillageUpdateRequest $request, Village $village): RedirectResponse
    {
        $village->update($request->validated());

        return redirect()
            ->route('master::villages.edit', $village)
            ->with('success', 'Village saved');
    }

    /**
     * @param Village $village
     * @throws \Exception
     * @return RedirectResponse
     */
    public function destroy(Village $village): RedirectResponse
    {
        try {
            $village->delete();

            return redirect()
                ->route('master::villages.index')
                ->with('success', 'Village deleted');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
