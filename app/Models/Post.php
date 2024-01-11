<?php

namespace App\Models;

use App\Models\Interfaces\TranslationInterface;
use App\Models\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model implements TranslationInterface
{
    use HasFactory, SoftDeletes, TranslationTrait;

    const DEFAULT_COUNT_POST_PER_PAGE = 15;

    protected $with = [
        'defaultTranslation'
    ];
    protected $appends = ['title', 'description', 'content'];

    public function title(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->title,
        );
    }

    public function description(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->description,
        );
    }

    public function content(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->content,
        );
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class, 'post_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id', 'id', 'id');
    }


}
