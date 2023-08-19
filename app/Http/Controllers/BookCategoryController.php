<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\StoreCategoriesRequest;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => BookCategory::paginate(5)
        ]);
    }

    /* Show the form for creating a new resource. */
    public function create()
    {
        return view('category.create');
    }

    /* Store a newly created resource in storage */
    public function store(StoreCategoriesRequest $request)
    {
        BookCategory::create($request->validated() + [
            'Status' => 'Y'
        ]);
        return redirect()->route('categories');
    }

    public function edit(BookCategory $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $categories = BookCategory::find($id);
        $categories->name = $request->name;
        $categories->save();
        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        BookCategory::findorfail($id)->delete();
        return redirect()->route('categories');
    }
}
