<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\ColorResource;
use Turahe\Master\Models\Color;

/**
 * @group Master
 *
 * Class ColorController
 */
class ColorController
{
    /**
     * List of colors.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $colors = app(Pipeline::class)
            ->send(Color::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->get();

        return ColorResource::collection($colors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return ColorResource
     */
    public function store(Request $request)
    {
        $color = Color::create($request->all());

        return new ColorResource($color);
    }

    /**
     * Display the specified resource.
     *
     * @param Color $color
     *
     * @return ColorResource
     */
    public function show(Color $color)
    {
        return new ColorResource($color);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Color                    $color
     *
     * @return ColorResource
     */
    public function update(Request $request, Color $color)
    {
        $color->update($request->all());

        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return response()->noContent();
    }
}
