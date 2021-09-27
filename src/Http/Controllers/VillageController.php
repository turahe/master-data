<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Turahe\Master\Http\Resources\VillageResource;
use Turahe\Master\Models\Village;

/**
 * @group Master Data Villages
 *
 * Class VillageController.
 */
class VillageController extends Controller
{
    /**
     * all villages.
     *
     *  @apiResource Turahe\Master\Http\Resources\VillageResource
     * @apiResourceModel Turahe\Master\Models\Village
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $villages = app(Pipeline::class)
            ->send(Village::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return VillageResource::collection($villages);
    }

    /**
     * Create new Village.
     *
     *  @apiResource Turahe\Master\Http\Resources\VillageResource
     * @apiResourceModel Turahe\Master\Models\Village
     *
     * @param Request $request
     *
     * @return VillageResource
     */
    public function store(Request $request)
    {
        $village = Village::create($request->input());

        return new VillageResource($village);
    }

    /**
     * Display a village.
     *
     *  @apiResource Turahe\Master\Http\Resources\VillageResource
     * @apiResourceModel Turahe\Master\Models\Village
     *
     * @urlParam id string required The ID of the village. Example: 1
     *
     * @param Village $village
     *
     * @return VillageResource
     */
    public function show(Village $village)
    {
        return new VillageResource($village);
    }

    /**
     * Change Village.
     *
     * @authenticated
     * @urlParam id string required The ID of the village. Example: 1
     *  @apiResource Turahe\Master\Http\Resources\VillageResource
     * @apiResourceModel Turahe\Master\Models\Village
     *
     * @param Request $request
     * @param Village $village
     *
     * @return VillageResource
     */
    public function update(Request $request, Village $village)
    {
        $village->update($request->input());

        return new VillageResource($village);
    }

    /**
     * Delete Village.
     *
     * @authenticated
     * @urlParam id string required The ID of the village. Example: 1
     *
     * @param Village $village
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        $village->delete();

        return response()->noContent();
    }
}
