<?php

namespace Turahe\Address\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Address\Http\Requests\Village\VillageStoreRequest;
use Turahe\Address\Http\Requests\Village\VillageUpdateRequest;
use Turahe\Address\Models\Village;
use Turahe\Address\Tables\KelurahanTable;

/**
 * Class VillageController
 * @package Turahe\Address\Http\Controllers
 */
class VillageController extends Controller
{
    /**
     * @return mixed
     */
    public function index(): View
    {
        $data = Village::with('districts')->autoSort()->autoFilter()->search(request('search'))->paginate();

        return (new KelurahanTable($data))
            ->title(__('Daftar Desa/Village'))
            ->view('address::villages.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('address::villages.create');
    }

    /**
     * @param VillageStoreRequest $request
     * @return mixed
     */
    public function store(VillageStoreRequest $request): RedirectResponse
    {
        Village::create($request->validated());

        return redirect()
            ->route('address::villages.index')
            ->with('success', 'Village saved');
    }

    /**
     * @param Village $village
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Village $village): View
    {
        return view('address::villages.edit', compact('village'));
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
            ->route('address::villages.edit', $village)
            ->with('success', 'Village saved');
    }

    /**
     * @param Village $village
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Village $village): RedirectResponse
    {
        try {
            $village->delete();

            return redirect()
                ->route('address::villages.index')
                ->with('success', 'Village deleted');
        } catch (QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
