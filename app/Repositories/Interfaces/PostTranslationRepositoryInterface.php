<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

interface PostTranslationRepositoryInterface
{

    public function create(array $data, Post $post, Language $language): PostTranslation;

    public function getByLang(Post $post, Language $language): ?PostTranslation;

    public function update(array $data, PostTranslation $postTranslation): mixed;

}
