<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        $title = 'جميع الكتب';
        return view('admin.authors.index', compact('authors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();

        session()->flash('flash_message', 'تمت إضافة الكاتب بنجاح');
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
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
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();

        session()->flash('flash_message', 'تمّ تعديل الكاتب بنجاح');
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        session()->flash('flash_message', 'تمّ حذف الكاتب بنجاح');
        return redirect()->route('authors.index');
    }

    public function list()
    {
        $authors = Author::all()->sortBy('name');
        $title = 'جميع المؤلفين';
        return view('authors.index', compact('authors', 'title'));
    }

    public function search(Request $request)
    {
        // dd($request);
        $authors = Author::where('name', 'like', '%' . $request->term . '%')->get();
        $term = $request->term;
        $title = 'البحث في المؤلفين';
        return view('authors.index', compact('authors', 'term', 'title'));
    }

    public function result(Author $author)
    {
        $books = $author->books()->paginate(12);
        $title = 'الكتب من المؤلف : ' . $author->name;
        return view('gallery', compact('books', 'title'));
    }
}
