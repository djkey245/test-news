<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostTranslationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class PostTranslationRepository implements PostTranslationRepositoryInterface
{

    public function create(array $data = [], Post $post, Language $language): PostTranslation
    {
        $data['post_id'] = $post->id;
        $data['language_id'] = $language->id;

        return PostTranslation::create($data);
    }

    public function update(array $data = [], PostTranslation $postTranslation): mixed
    {
        return $postTranslation->update($data);
    }

    public function getByLang(Post $post, Language $language): ?PostTranslation
    {
        return PostTranslation::where('post_id', '=', $post->id)->where('language_id', '=', $language->id)->first();
    }

}
