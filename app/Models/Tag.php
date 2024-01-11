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

class Tag extends Model implements TranslationInterface
{
    use HasFactory, SoftDeletes, TranslationTrait;

    protected $fillable = ['post_id'];

    protected $with = [
        'defaultTranslation'
    ];

    protected $appends = ['name'];

    public function name(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->name,
        );
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id', 'id', 'id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(TagTranslation::class, 'tag_id', 'id');
    }

}
