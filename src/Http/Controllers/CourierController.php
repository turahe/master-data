<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\CourierResource;
use Turahe\Master\Models\Courier;

/**
 * @group Master Data Courier
 *
 * Class CourierController
 * @package App\Http\Controllers\Api
 */
class CourierController
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource Turahe\Master\Http\Resources\CourierResource
     * @apiResourceModel Turahe\Master\Models\Courier
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $couriers = app(Pipeline::class)
            ->send(Courier::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return  CourierResource::collection($couriers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource Turahe\Master\Http\Resources\CourierResource
     * @apiResourceModel Turahe\Master\Models\Courier
     *
     * @param Request $request
     * @return CourierResource
     */
    public function store(Request $request)
    {
        $courier = Courier::create($request->input());
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $courier->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        return  new CourierResource($courier);
    }

    /**
     * Display the specified resource.
     *
     * @apiResource Turahe\Master\Http\Resources\CourierResource
     * @apiResourceModel Turahe\Master\Models\Courier
     *
     * @param Courier $courier
     * @return CourierResource
     */
    public function show(Courier $courier)
    {
        return  new CourierResource($courier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiResource Turahe\Master\Http\Resources\CourierResource
     * @apiResourceModel Turahe\Master\Models\Courier
     *
     * @param Request $request
     * @param Courier $courier
     * @return CourierResource
     */
    public function update(Request $request, Courier $courier)
    {
        $courier->update($request->input());
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $courier->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        $courier->update($request->input());

        return  new CourierResource($courier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @apiResource Turahe\Master\Http\Resources\CourierResource
     * @apiResourceModel Turahe\Master\Models\Courier
     *
     * @param Courier $courier
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();

        return response()->noContent();
    }
}
