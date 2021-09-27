<?php

namespace Turahe\Master\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Models\Currency;

/**
 * @group Master Data Currency
 *
 * Class CurrencyController.
 */
class CurrencyController
{
    /**
     * Display a listing of the resource.
     *
     * @apiResource Turahe\Master\Http\Resources\CurrencyResource
     * @apiResourceModel Turahe\Master\Models\Currency
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $currencies = app(Pipeline::class)
            ->send(Currency::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return CurrencyResource::collection($currencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiResource Turahe\Master\Http\Resources\CurrencyResource
     * @apiResourceModel Turahe\Master\Models\Currency
     *
     * @param Request $request
     *
     * @return CurrencyResource
     */
    public function store(Request $request)
    {
        $currency = Currency::create($request->input());

        return  new CurrencyResource($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiResource Turahe\Master\Http\Resources\CurrencyResource
     * @apiResourceModel Turahe\Master\Models\Currency
     *
     * @param Request  $request
     * @param Currency $currency
     *
     * @return CurrencyResource
     */
    public function update(Request $request, Currency $currency)
    {
        $currency->update($request->input());

        return  new CurrencyResource($currency);
    }

    /**
     * Detail.
     *
     * @apiResource Turahe\Master\Http\Resources\CurrencyResource
     * @apiResourceModel Turahe\Master\Models\Currency
     *
     * @param Currency $currency
     *
     * @return CurrencyResource
     */
    public function show(Currency $currency)
    {
        return  new CurrencyResource($currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return response()->noContent();
    }
}
