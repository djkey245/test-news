<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Repositories\Interfaces\TagTranslationRepositoryInterface;

class TagTranslationRepository implements TagTranslationRepositoryInterface
{

    public function create(array $data = [], Tag $tag, Language $language): TagTranslation
    {
        $data['tag_id'] = $tag->id;
        $data['language_id'] = $language->id;

        return TagTranslation::create($data);
    }

    public function update(array $data = [], TagTranslation $translation): mixed
    {
        return $translation->update($data);
    }

    public function getByLang(Tag $tag, Language $language): ?TagTranslation
    {
        return TagTranslation::where('tag_id', '=', $tag->id)->where('language_id', '=', $language->id)->first();
    }

}
