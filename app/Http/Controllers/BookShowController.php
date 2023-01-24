<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::with('fourBooks')->get();



        // dd($categories);
        // $categories = Category::with('books')->paginate(10);
        // $category = Category::find(1);
        // $books = $category->books()->paginate(10);
        // return view('show_books', compact('category','books'));
        return view('/template', compact('categories'));
        // return view('/template');
    }


    public function category_view_all($slug)
    {
        $categories = Category::get();
        // $books = $category->books()->paginate(10);
        $category = Category::where('slug', $slug)->with('books')->get();
        // dd($categories);
        return view('/template', compact('category', 'categories'));
    }

    public function book_view($slug)
    {
        // $categories = Category::get();
        // $books = $category->books()->paginate(10);
        // $book = Book::where('slug', $slug)->with('category')->with('publisher')->with('keywords')->get();
        $book = Book::where('slug', $slug)->with('category')->with('publisher')->with('keywords')->first();
        $publisher_id = $book->publisher->id;
        $publisher_books = Publisher::where('id', $publisher_id)->with('books')->first();
        // dd($book);

        return view('/book', compact('book', 'publisher_books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
