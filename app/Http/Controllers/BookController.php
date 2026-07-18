<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function create_book() {
        $categories = Categorie::all();
        return view('create_book', compact('categories'));
    }
    public function store_book(Request $request) {
        $request->validate([
            'stock' => 'required',
            'categorie_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $file = $request->file('cover_image');
        $path = time() . '_' . $request->title . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public', $path);
        $isbn = time();
        Book::create([
            'title' => $request->title,
            'categorie_id' => $request->categorie_id,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish_year' => $request->publish_year,
            'description' => $request->description,
            'cover_image' => $path,
            'isbn' => $isbn,
            'stock' => $request->stock
        ]);
        return Redirect::back();
    }
    public function index_book() {
        
        $books = Book::all();
        return view('index_book', compact('books'));
    }
    public function show_book(Book $book) {
        return view('show_book', compact('book'));
    }
    public function edit_book(Book $book) {
        $categorie_id = $book->categorie->id;
        $categories = Categorie::where('id' , '!=', $categorie_id)->get();
        return view('edit_book', compact('book', 'categories'));
    }
    public function update_book(Request $request, Book $book) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required',
            'description' => 'required',
            'categorie_id' => 'required',
            'stock' => 'required',
            'cover_image' => 'nullable|mimes:jpg,png,jpeg|image|max:2048'
        ]);
        $path = $book->cover_image;
        if($request->hasFile('cover_image')) {
            if($book->cover_image) {
                Storage::disk('local')->delete('public/'. $book->cover_image);
            }
            $file = $request->file('cover_image');
            $path = time() . '_' . $request->title . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $path);
        }
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish_year' => $request->publish_year,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'stock' => $request->stock,
            'cover_image' => $path
        ]);
        return Redirect::route('show_book', $book);
    }
    public function delete_book(Book $book) {
        Storage::disk('local')->delete('public/'. $book->cover_image);
        $book->delete();
        return Redirect::route('index_book');
    }
}
