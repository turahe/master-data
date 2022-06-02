<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\StateResource;
use Turahe\Master\Models\State;

/**
 * @group Master Data Province
 *
 * Class ProvinceController.
 */
class ProvinceController
{
    /**
     * List of state/province.
     *
     * Get all Province by country id
     *
     * @apiResource Turahe\Master\Http\Resources\StateResource
     * @apiResourceModel Turahe\Master\Models\Province
     *
     * @param $id
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $states = app(Pipeline::class)
            ->send(State::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
                \Turahe\Master\Http\Pipelines\Country::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return StateResource::collection($states);
    }

    /**
     * Create a province or country.
     *
     * @authenticated
     * @apiResource Turahe\Master\Http\Resources\StateResource
     * @apiResourceModel Turahe\Master\Models\Province
     *
     * @param Request $request
     *
     * @return StateResource
     */
    public function store(Request $request)
    {
        $state = State::create($request->input());

        return new StateResource($state);
    }

    /**
     * Change state/province.
     *
     * @authenticated
     * @apiResource Turahe\Master\Http\Resources\StateResource
     * @apiResourceModel Turahe\Master\Models\Province
     *
     * @param Request $request
     * @param State   $state
     *
     * @return StateResource
     */
    public function update(Request $request, State $state)
    {
        $state->update($request->input());

        return new StateResource($state);
    }

    /**
     * View all  province/state.
     *
     * @apiResource Turahe\Master\Http\Resources\StateResource
     * @apiResourceModel Turahe\Master\Models\Province
     *
     * @param State $state
     *
     * @return StateResource
     */
    public function show(State $state)
    {
        return new StateResource($state);
    }

    /**
     * Delete a state/province.
     *
     * @authenticated
     *
     * @param State $state
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();

        return response()->noContent();
    }
}