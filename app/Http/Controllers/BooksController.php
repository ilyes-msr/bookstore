<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('admin.books.create', compact('authors', 'publishers', 'categories'));
    }
    public function store(CreateBookRequest $request)
    {

        $validatedData = $request->validated();

        // $photo = $request->file('cover_image');
        // $path = $photo->store('images/covers', 'public');

        $book = Book::create([
            'title' => $validatedData['title'],
            'isbn' => $validatedData['isbn'],
            'category_id' => $validatedData['category'],
            'publisher_id' => $validatedData['publisher'],
            'description' => $request->input('description'),
            'publish_year' => $request->input('publish_year'),
            'number_of_pages' => $validatedData['number_of_pages'],
            'number_of_copies' => $validatedData['number_of_copies'],
            'price' => $validatedData['price'],
            'cover_image' => $this->uploadImage($validatedData['cover_image']),
        ]);

        $book->authors()->attach($validatedData['authors']);

        session()->flash('flash_message', 'تمّت إضافة الكتاب بنجاح');
        return redirect()->route('books.show', $book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
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
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('admin.books.edit', compact('authors', 'publishers', 'categories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validated();

        // $photo = $request->file('cover_image');
        // $path = $photo->store('images/covers', 'public');

        $book->title = $validatedData['title'];
        if ($request->has('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
            $book->cover_image = $this->uploadImage($request->cover_image);
        }
        $book->isbn = $validatedData['isbn'];
        $book->number_of_pages = $validatedData['number_of_pages'];
        $book->category_id = $validatedData['category'];
        $book->publisher_id = $validatedData['publisher'];
        $book->number_of_copies = $validatedData['number_of_copies'];
        $book->price = $validatedData['price'];

        $book->save();
        $book->authors()->detach();
        $book->authors()->attach($validatedData['authors']);

        session()->flash('flash_message', 'تمّ تعديل الكتاب بنجاح');
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

        Storage::disk('public')->delete($book->cover_image);

        // $book->authors()->detach();

        $book->delete();

        session()->flash('flash_message', 'تمّ حذف الكتاب بنجاح');

        return redirect()->route('books.index');
    }

    public function details(Book $book)
    {
        return view('books.details', compact('book'));
    }
}
