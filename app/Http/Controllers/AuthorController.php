<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class AuthorController extends Controller
{
    const RESULTS_IN_PAGE = 9;
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
        $authors = Author::all();
        return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
                'author_name' => ['required', 'min:3', 'max:64'],
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],
            [
                'author_name.required' => 'author name required',
                'author_name.max' => 'author name too long',
                'author_name.min' => 'author name too short',
                'author_surname.max' => 'author surname too long',
                'author_surname.min' => 'author surname too short'

            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $author = new Author;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();

        return redirect()->route('author.index')->with('success_message', 'succesfully recorded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $author = Author::where('id', $author->id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('author.show', ['author' => $author]);
    }
    public function uploadPhoto(Author $author, Request $request)
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5) . ".jpg";
            $folder = public_path('/authorPhoto');
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder . '/' . $fileName, 80, 'jpg');
            $author->photo_name = $fileName;
            $author->save();
        }
        return redirect()->route('author.index', ['author' => $book]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'author_name' => ['required', 'min:3', 'max:64'],
                'author_surname' => ['required', 'min:3', 'max:64'],
            ],
            [
                'author_name.required' => 'author name required',
                'author_name.max' => 'author name too long',
                'author_name.min' => 'author name too short',
                'author_surname.max' => 'author surname too long',
                'author_surname.min' => 'author surname too short'

            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
        return redirect()->route('author.index')->with('success_message', 'succesfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->authorBooks->count()) {
            return 'Cannot delete because it has books';
        }
        $author->delete();
        return redirect()->route('author.index')->with('success_message', 'succesfully deleted');
    }
}
