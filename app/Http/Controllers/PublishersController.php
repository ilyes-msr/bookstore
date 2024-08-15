<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publishers.create');
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
            'address' => 'nullable'
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();

        session()->flash('flash_message', 'تمت إضافة الناشر بنجاح');
        return redirect()->route('publishers.index');
    }

    public function show(Publisher $publisher) {}

    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable'
        ]);

        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();

        session()->flash('flash_message', 'تمّ تعديل بيانات الناشر بنجاح');
        return redirect()->route('publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        session()->flash('flash_message', 'تمّ حذف الناشر');
        return redirect()->route('publishers.index');
    }

    public function list()
    {
        $publishers = Publisher::all()->sortBy('name');
        $title = 'جميع الناشرين';
        return view('publishers.index', compact('publishers', 'title'));
    }

    public function search(Request $request)
    {
        // dd($request);
        $publishers = Publisher::where('name', 'like', '%' . $request->term . '%')->get();
        $term = $request->term;
        $title = 'البحث في الناشرين';
        return view('publishers.index', compact('publishers', 'term', 'title'));
    }

    public function result(Publisher $publisher)
    {
        $books = $publisher->books()->paginate(12);
        $title = 'الكتب من الناشر : ' . $publisher->name;
        return view('gallery', compact('books', 'title'));
    }
}
