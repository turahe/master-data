<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\StateResource;
use Turahe\Master\Models\State;

/**
 * @group Master
 *
 * Class StateController.
 */
class StateController
{
    /**
     * List of state/province.
     *
     * Get all State by country id
     *
     * @param $id
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($id)
    {
        $states = app(Pipeline::class)
            ->send(State::where('country_id', $id))
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->get();

        return StateResource::collection($states);
    }

    /**
     * Create a province or country.
     *
     * @authenticated
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
