<?php

namespace Turahe\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Turahe\Master\Http\Resources\LanguageResource;
use Turahe\Master\Models\Language;

/**
 * @group Language Data Languages
 *
 * Class LanguageController.
 */
class LanguageController
{
    /**
     * List of language.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $languages = app(Pipeline::class)
            ->send(Language::query())
            ->through([
                \Turahe\Master\Http\Pipelines\Sort::class,
                \Turahe\Master\Http\Pipelines\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return LanguageResource::collection($languages);
    }

    /**
     * Create a language.
     *
     * @authenticated
     * @apiResource Turahe\Master\Http\Resources\LanguageResource
     * @apiResourceModel Turahe\Master\Models\Language
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return LanguageResource
     */
    public function store(Request $request)
    {
        $language = Language::create($request->input());

        return new LanguageResource($language);
    }

    /**
     * View language.
     *
     * @apiResource Turahe\Master\Http\Resources\LanguageResource
     * @apiResourceModel Turahe\Master\Models\Language
     *
     * @param Language $language
     *
     * @return LanguageResource
     */
    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

    /**
     * Change language.
     *
     * @authenticated
     * @apiResource Turahe\Master\Http\Resources\LanguageResource
     * @apiResourceModel Turahe\Master\Models\Language
     *
     * @param \Illuminate\Http\Request $request
     * @param Language                 $language
     *
     * @return LanguageResource
     */
    public function update(Request $request, Language $language)
    {
        $language->update($request->input());

        return new LanguageResource($language);
    }

    /**
     * Delete language.
     *
     * @authenticated
     *
     * @param Language $language
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return response()->noContent();
    }
}
