<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'language_id', 'tag_id'];

    public function language()
    {
        return $this->hasOne(Language::class);
    }

}
