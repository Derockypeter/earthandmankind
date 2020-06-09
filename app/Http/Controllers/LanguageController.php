<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
class LanguageController extends Controller
{
    // Stores a new language
    public function store(Request $request)
    {
        $lang = Language::updateOrCreate([
            'language' => $request->language
        ]);
        return response()->json($lang);
    }

    // Gets all the language
    public function language()
    {
        $lang = Language::all();
        if ($lang){
            return response()->json($lang);
        }
        else {
            return 0;
        }
    }

    // Gets it back for editing
    public function edit($id)
    {
        $lang = Language::findOrFail($id);
        if ($lang) {
            return response()->json($lang);
        }
        else {
            return 0;
        }
    }

    // Update a Language
    public function update(Request $request, $id)
    {
        $lang = Language::findOrFail($id);
        if ($lang) {
            $newLang = $lang->update([
                'language' => $request->language
            ]);
            return response()->json($newLang);
        }
        else {
            return 0;
        }
    }

    // Deleting a lang
    public function delete($id)
    {
        $lang = Language::findOrFail($id);
        if ($lang) {
            $lang->delete();
            return response()->json(['message' => 'Language deleted'], 204);
        }
        else {
            return 0;
        }
    }
}
