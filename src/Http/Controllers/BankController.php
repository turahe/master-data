<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\BankResource;
use Turahe\Master\Models\Bank;

/**
 * @group Master
 *
 * Class BankController
 * @package Turahe\Master\Http\Controllers\Api
 */
class BankController
{
    /**
     * Display a listing of the resource.
     *
     * @authenticated
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $banks = app(Pipeline::class)
            ->send(Bank::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->get();

        return BankResource::collection($banks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @authenticated
     * @urlParam id string required The ID of the bank. Example: 1
     * @param  \Illuminate\Http\Request  $request
     * @return BankResource
     */
    public function store(Request $request)
    {
        $bank = Bank::create($request->all());

        return new BankResource($bank);
    }

    /**
     * Display the specified resource.
     *
     * @urlParam id string required The ID of the bank. Example: 1
     * @param Bank $bank
     * @return BankResource
     */
    public function show(Bank $bank)
    {
        return new BankResource($bank);
    }

    /**
     * Update the specified resource in storage.
     *
     * @authenticated
     * @urlParam id string required The ID of the bank. Example: 1
     * @param \Illuminate\Http\Request $request
     * @param Bank $bank
     * @return BankResource
     */
    public function update(Request $request, Bank $bank)
    {
        $bank->update($request->all());

        return new BankResource($bank);
    }

    /**
     * Remove bank.
     *
     * @authenticated
     * @urlParam id string required The ID of the bank. Example: 1
     * @param Bank $bank
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return response()->noContent();
    }
}
