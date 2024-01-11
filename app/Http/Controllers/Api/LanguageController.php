<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LanguageResource::collection($this->languageRepository->all());
    }

}
