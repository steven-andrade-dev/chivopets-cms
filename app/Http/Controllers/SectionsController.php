<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function show()
    {
        $sections = array();
        for ($i = 0; $i < 10; $i++) {
            $sections[] = [
                'id' => $i,
                'name' => 'Sección ' . $i,
                'slug' => 'seccion-' . $i,
            ];
        }
        return response()->json([
            'data' => $sections
        ]);
    }
}
