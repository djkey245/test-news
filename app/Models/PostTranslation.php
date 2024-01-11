<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'content', 'language_id', 'post_id'];

    public function language()
    {
        return $this->hasOne(Language::class);
    }
}
