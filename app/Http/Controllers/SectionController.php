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

    public function indexSection()
    {
        $section = Section::query()->get();
        return response()->json([
            'section' => $section
        ]);
    }

    public function deleteSection(Section $section)
    {
        $section->delete();
        return response()->json([
            'message' => 'Section Deleted'
        ]);
    }

    public function updateSection(Section $section,Request $request)
    {
        $data = $request->validate([
            'section_name' => 'required'
        ]);
        $section->update($data);
        return response()->json([
            'message' => 'Section Updated',
            'Section' => $section
        ]);
    }
}
