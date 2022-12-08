<?php

namespace App\Http\Controllers;

use App\Data\ICU;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function list()
    {
        $languages = ICU::get_languages();

        return response()->json([
            'message' => 'Languages fetched successfully!',
            'data' => $languages
        ]);
    }
}
