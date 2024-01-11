<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface TagRepositoryInterface
{
    public function __construct(TagTranslationRepositoryInterface $tagTranslationRepository);

    public function create(array $data, Post $post): Tag;

    public function update(array $data, Post $post, Tag $tag): mixed;

    public function delete(Tag $tag): mixed;

    public function saveTranslations(array $data, Tag $tag): void;

    public function showWithTranslations(Tag $tag): Tag;
}
