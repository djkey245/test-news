<?php

namespace App\Models\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait TranslationTrait
{

    public function defaultTranslation(): HasOne
    {
        $language = Language::wherePrefix(session()->get('locale', app()->getLocale()))->first();
        return $this->translations()->one()->where('language_id', '=', $language->id);
    }

    public function scopeWithLang(Builder $builder, Language $language)
    {
        $builder->with('translations')->whereHas('translations', function (Builder $builder) use ($language) {
            $builder->where('language_id', '=', $language->id);
        });
    }

    public function scopeWithDefaultTranslation(Builder $builder)
    {
        $builder->with('defaultTranslation')->has('defaultTranslation');
    }

}
