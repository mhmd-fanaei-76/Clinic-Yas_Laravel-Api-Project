<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function createSection(Request $request)
    {
        $data = $request->validate([
            'section_name' => 'required',
        ]);
        $section = Section::query()->create($data);
        return response()->json([
            'message' => 'section was created'
        ]);
    }
}
