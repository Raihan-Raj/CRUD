<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreBookRequest;
use App\Models\Author;
use App\Models\BookCategory;
use App\Models\BookList;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Str;


class BookListController extends Controller
{
    //Add Book

    protected $model;

    public function __construct(BookList $booklist)
    {
        $this->model = $booklist;
    }

    public function books()
    {

        return view('admin.Book.index', [
            'books' => BookList::paginate(5)
        ]);
    }
    /* Show the form for creating a new resource. */

    public function create()
    {

        return view('admin.Book.create', [
            'authors' => Author::latest()->get(),
            'categories' => BookCategory::latest()->get(),
        ]);
        return redirect()->route('books');
    }

    /* Store a newly created resource in storage. */
    public function store(StoreBookRequest $request)
    {
        BookList::create($request->validated() + [
            'Status' => 'Y'
        ]);
        return redirect()->route('books');
    }

    /* Show the form for editing the specified resource */
    public function edit(BookList $book)
    {
        return view('admin.book.edit', [
            'authors' => Author::latest()->get(),
            'categories' => BookCategory::latest()->get(),
            'book' => $book
        ]);
    }

    public function update(BookUpdateRequest $request, $id)
    {
        $book = BookList::find($id);
        $book->name = $request->name;
        $book->quantity = $request->quantity;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->save();
        return redirect()->route('books');
    }

    public function destroy($id)
    {
        BookList::findorfail($id)->delete();
        return redirect()->route('books');
    }
}
