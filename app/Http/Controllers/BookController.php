<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'book_title' => ['required', 'min:3', 'max:64'],
                'book_isbn' => ['required', 'min:5', 'max:64'],
                'book_pages' => ['required', 'min:1', 'max:1000'],
                'book_about' => ['required', 'min:1', 'max:100'],
            ],
            [
                'book_title.required' => 'book title required',
                'book_isbn.required' => 'book isbn required',
                'book_pages.required' => 'book pages required',
                'book_about.required' => 'book description required',
                'book_title.min' => 'book title too short',
                'book_title.max' => ' book title too long',
                'book_isbn.max' => 'book isbn too long',
                'book_isbn.min' => 'book isbn too short',
                'book_pages.max' => 'book page too much',
                'book_pages.min' => 'book page too litle',
                'book_about.max' => 'book description too large',
                'book_pages.min' => 'book description too small'
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'succesfully recorded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = Book::where('id', $book->id)->get();
        return view('book.show', ['book' => $book]);
    }
    public function uploadPhoto(Book $book, Request $request)
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5) . ".jpg";
            $folder = public_path('/bookPhoto');
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder . '/' . $fileName, 80, 'jpg');
            $book->photo_name = $fileName;
            $book->save();
        }
        return redirect()->route('book.index', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'book_title' => ['required', 'min:3', 'max:64'],
                'book_isbn' => ['required', 'min:5', 'max:64'],
                'book_pages' => ['required', 'min:1', 'max:1000'],
                'book_about' => ['required', 'min:1', 'max:100'],
            ],
            [
                'book_title.required' => 'book title required',
                'book_isbn.required' => 'book isbn required',
                'book_pages.required' => 'book pages required',
                'book_about.required' => 'book description required',
                'book_title.min' => 'book title too short',
                'book_title.max' => ' book title too long',
                'book_isbn.max' => 'book isbn too long',
                'book_isbn.min' => 'book isbn too short',
                'book_pages.max' => 'book page too much',
                'book_pages.min' => 'book page too litle',
                'book_about.max' => 'book description too large',
                'book_pages.min' => 'book description too small'
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'succesfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success_message', 'succesfully deleted.');
    }
}
