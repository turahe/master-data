<?php

namespace Turahe\Master\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\CityResource;
use Turahe\Master\Models\City;

/**
 * @group Master
 *
 * Class CityController.
 */
class CityController
{
    /**
     * All Cities.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cities = app(Pipeline::class)
            ->send(City::query())
            ->through([
                \Turahe\Master\Http\Pipelines\State::class,
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->get();

        return CityResource::collection($cities);
    }

    /**
     * create city.
     *
     * @param Request $request
     * @return CityResource
     */
    public function store(Request $request)
    {
        $city = City::create($request->input());

        return new CityResource($city);
    }

    /**
     * change city.
     *
     * @param Request $request
     * @param City $city
     * @return CityResource
     */
    public function update(Request $request, City $city)
    {
        $city->update($request->input());

        return new CityResource($city);
    }

    /**
     * view city.
     *
     * @param City $city
     * @return CityResource
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * delete city.
     *
     * @param City $city
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->noContent();
    }
}
