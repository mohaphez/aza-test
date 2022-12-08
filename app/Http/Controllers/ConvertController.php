<?php

namespace App\Http\Controllers;

use Salarmehr\Cosmopolitan\Cosmo;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    public function spellout(Request $request)
    {
        $request->validate(['language' => 'required|string', 'number' => 'required|numeric']);

        $result = Cosmo::create($request->get('language'))
            ->spellout(floatval($request->get('number')));

        return response()->json([
            'message' => 'Data Converted successfully!',
            'data' => ["spellout" => $result]
        ]);
    }
}
