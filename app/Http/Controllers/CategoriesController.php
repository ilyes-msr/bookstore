<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $title = 'جميع التصنيفات';
        return view('admin.categories.index', compact('categories', 'title'));
    }

    public function list()
    {
        $categories = Category::all();
        $title = 'جميع التصنيفات';
        return view('categories.index', compact('categories', 'title'));
    }

    public function search(Request $request)
    {
        // dd($request);
        $categories = Category::where('name', 'like', '%' . $request->term . '%')->get();
        $term = $request->term;
        $title = 'البحث في التصنيفات';
        return view('categories.index', compact('categories', 'term', 'title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        session()->flash('flash_message', 'تمت إضافة الصنف بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        session()->flash('flash_message', 'تمّ تعديل الصنف بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('flash_message', 'تمّ حذف الصنف بنجاح');
        return redirect()->route('categories.index');
    }

    public function result(Category $category)
    {
        $books = $category->books()->paginate(12);
        $title = 'الكتب من الصنف : ' . $category->name;
        return view('gallery', compact('books', 'title'));
    }
}
