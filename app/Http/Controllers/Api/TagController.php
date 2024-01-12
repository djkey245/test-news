<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexTagRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Language;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\TagRepository;

class TagController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexTagRequest $request, Post $post)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : Post::DEFAULT_COUNT_POST_PER_PAGE;
        if ($request->has('locale')) {
            session(['locale' => $request->get('locale')]);
            $language = Language::wherePrefix($request->get('locale'))->first();
        } else {
            $language = Language::wherePrefix(app()->getLocale())->first();
        }

        return PostResource::collection($this->tagRepository->paginate($perPage, $language, $post));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request, Post $post)
    {
        $tag = $this->tagRepository->create([], $post);
        $this->tagRepository->saveTranslations($request->validated(), $tag);
        return new TagResource($this->tagRepository->showWithTranslations($tag));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Tag $tag)
    {
        return new TagResource($tag->load('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Post $post, Tag $tag)
    {
        $this->tagRepository->update([], $post, $tag);
        $this->tagRepository->saveTranslations($request->validated(), $tag);
        return new TagResource($this->tagRepository->showWithTranslations($tag));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Tag $tag)
    {
        $this->tagRepository->delete($tag);
        return response()->json(null, 204);
    }
}
