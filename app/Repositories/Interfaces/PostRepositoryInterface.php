<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

interface PostRepositoryInterface
{
    public function __construct(PostTranslationRepositoryInterface $postTranslationRepository);

    public function all(): Collection;

    public function getAllWithPagination(?int $perPage, ?Language $language): ?LengthAwarePaginator;

    public function create(array $data): Post;

    public function update(array $data, Post $post): mixed;

    public function delete(Post $post): mixed;

    public function saveTranslations(array $data, Post $post): void;

    public function showWithTranslations(Post $post): Post;

    public function searchWithPagination(string $searchString, int $perHour): ?LengthAwarePaginator;

}
