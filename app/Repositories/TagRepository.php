<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TagTranslationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TagRepository implements TagRepositoryInterface
{
    private $tagTranslationRepository;

    public function __construct(TagTranslationRepositoryInterface $tagTranslationRepository)
    {
        $this->tagTranslationRepository = $tagTranslationRepository;
    }

    public function all(): Collection
    {
        return Tag::all();
    }

    public function paginate(?int $perPage, ?Language $language, Post $post): ?LengthAwarePaginator
    {
        return $post->tags()->withDefaultTranslation($language)->paginate($perPage);
    }

    public function create(array $data, Post $post): Tag
    {
        return $post->tags()->create($data);
    }

    public function update(array $data, Post $post, Tag $tag): mixed
    {
        return $tag->update($data);
    }

    public function delete(Tag $tag): mixed
    {
        return $tag->delete();
    }

    public function saveTranslations(array $data, Tag $tag): void
    {
        collect($data)->map(function ($translation) use ($tag) {
            $language = Language::wherePrefix($translation['language'])->first();
            $tagTranslation = $this->tagTranslationRepository->getByLang($tag, $language);
//            dd($tagTranslation, $translation);
            if ($tagTranslation) {
                $this->tagTranslationRepository->update($translation, $tagTranslation);
            } else {
                $this->tagTranslationRepository->create($translation, $tag, $language);
            }
        });
    }

    public function showWithTranslations(Tag $tag): Tag
    {
        return $tag->load('translations');
    }
}
