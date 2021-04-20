<?php

namespace Turahe\Master\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Storage;
use Turahe\Master\Http\Requests\CountryRequest;
use Turahe\Master\Http\Resources\CountryResource;
use Turahe\Master\Models\Country;

/**
 * @group Master
 *
 * Class CountryController.
 */
class CountryController
{
    /**
     * List of country.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $countries = app(Pipeline::class)
            ->send(Country::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
           ->get();

        return CountryResource::collection($countries);
    }

    /**
     * @param Request $request
     * @return CountryResource
     */
    public function store(Request $request)
    {
        $country = Country::create($request->all());

        if ($request->hasFile('flag') && $request->file('flag')->isValid()) {
            $image = $request->file('flag');
            $path = Storage::put(config('filesystems.default'), $image);
        }

        return  new CountryResource($country);
    }

    /**
     * @param Country $country
     * @param Request $request
     * @return CountryResource
     */
    public function update(Country $country, Request $request)
    {
        $country->update($request->all());

        if ($request->hasFile('flag') && $request->file('flag')->isValid()) {
            $image = $request->file('flag');
            $path = Storage::put(config('filesystems.default'), $image);
        }

        return  new CountryResource($country);
    }

    /**
     * @param Country $country
     * @return CountryResource
     */
    public function show(Country $country)
    {
        return  new CountryResource($country);
    }

    /**
     * @param Country $country
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->noContent();
    }
}
