<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{
    public function __construct(Language $language);

    public function all(): Collection;

}
