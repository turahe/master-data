<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Requests\DistrictRequest;
use Turahe\Master\Http\Resources\DistrictResource;
use Turahe\Master\Models\District;

/**
 * @group Master
 *
 * Class DistrictController.
 */
class DistrictController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $districts = app(Pipeline::class)
            ->send(District::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->get();

        return  DistrictResource::collection($districts);
    }

    /**
     * @param Request $request
     * @return DistrictResource
     */
    public function store(Request $request)
    {
        $district = District::create($request->input());

        return new DistrictResource($district);
    }

    /**
     * @param District $district
     * @return DistrictResource
     */
    public function show(District $district)
    {
        return new DistrictResource($district);
    }

    /**
     * @param District $district
     * @param Request $request
     * @return DistrictResource
     */
    public function update(District $district, Request $request)
    {
        $district->update($request->input());

        return new DistrictResource($district);
    }

    /**
     * @param District $district
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();

        return response()->noContent();
    }
}
