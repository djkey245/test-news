<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostTranslationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostRepository implements PostRepositoryInterface
{
    private $postTranslationRepository;

    public function __construct(PostTranslationRepositoryInterface $postTranslationRepository)
    {
        $this->postTranslationRepository = $postTranslationRepository;

    }

    public function all(): Collection
    {
        return Post::all();
    }

    public function paginate(?int $perPage, ?Language $language): ?LengthAwarePaginator
    {
        return Post::query()->withDefaultTranslation($language)->with('tags')->paginate($perPage);
    }


    public function create(array $data = []): Post
    {
        return Post::create($data);
    }

    public function update(array $data = [], Post $post): mixed
    {
        return $post->update($data);
    }

    public function delete(Post $post): mixed
    {
        return $post->delete();
    }

    public function saveTranslations(array $data, Post $post): void
    {
        collect($data)->map(function ($translation) use ($post) {
            $language = Language::wherePrefix($translation['language'])->first();
            $postTranslation = $this->postTranslationRepository->getByLang($post, $language);
            if ($postTranslation) {
                $this->postTranslationRepository->update($translation, $postTranslation);
            } else {
                $this->postTranslationRepository->create($translation, $post, $language);
            }
        });
    }

    public function showWithTranslations(Post $post): Post
    {
        return $post->load('translations');
    }

}
