<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;
use App\Models\Tag;
use App\Models\TagTranslation;

interface TagTranslationRepositoryInterface
{
    public function create(array $data, Tag $tag, Language $language): TagTranslation;

    public function getByLang(Tag $tag, Language $language): ?TagTranslation;

    public function update(array $data, TagTranslation $translation): mixed;

}
