<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Language;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostTranslationRepositoryInterface;
use App\Repositories\PostTranslationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : Post::DEFAULT_COUNT_POST_PER_PAGE;
        if ($request->has('locale')) {
            session(['locale' => $request->get('locale')]);
            $language = Language::wherePrefix($request->get('locale'))->first();
        } else {
            $language = Language::wherePrefix(app()->getLocale())->first();
        }

        return PostResource::collection($this->postRepository->getAllWithPagination($perPage, $language));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postRepository->create();
        $this->postRepository->saveTranslations($request->validated(), $post);
        return new PostResource($this->postRepository->showWithTranslations($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->postRepository->update([], $post);
        $this->postRepository->saveTranslations($request->validated(), $post);
        return new PostResource($this->postRepository->showWithTranslations($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postRepository->delete($post);
        return response()->json(null, 204);
    }

    public function search(SearchPostRequest $request)
    {
        $searchString = $request->get('query');
        $perPage = $request->has('per_page') ? $request->get('per_page') : Post::DEFAULT_COUNT_POST_PER_PAGE;
        if ($request->has('locale')) session(['locale' => $request->get('locale')]);

        return PostResource::collection($this->postRepository->searchWithPagination($searchString, $perPage));
    }
}
