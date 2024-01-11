<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements LanguageRepositoryInterface
{
    private $model;

    public function __construct(Language $language)
    {
        $this->model = $language;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
