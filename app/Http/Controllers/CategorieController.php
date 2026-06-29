<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class CategorieController extends Controller
{
    //
    public function create_category() {
        return view('create_category');
    }
    public function store_category(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);
        $slug = Str::slug($request->name);
        Categorie::create([
            'name' => $request->name,
            'slug' => $slug
        ]);
        return Redirect::back();
    }
    public function index_categorie() {
        $categories = Categorie::all();
        return view('index_categorie', compact('categories'));
    }
}
