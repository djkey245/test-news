<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;

interface TranslationInterface
{
    public function translations(): HasMany;

}
