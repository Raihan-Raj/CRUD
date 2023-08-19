<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Requests\storeauthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    /* Display a listing of the resource. */

    public function authors()
    {
        return view('author.index',  [
            'authors' => Author::paginate(5)
        ]);
    }
    /*Show the form for creating a new resource */

    public function create()
    {
        return view('author.crate');
    }

    /* Store a newly created resource in storage */

    public function store(storeauthorRequest $request)
    {
        Author::create($request->validated());
        return redirect()->route('authors');
    }

    /* Show the form for editing the specified resource */
    public function edit(author $author)
    {
        return view('author.edit', [
            'author' => $author
        ]);
    }

    /* Update the specified resource in storage */
    public function update(AuthorUpdateRequest $request, $id)
    {
        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();
        return redirect()->route('authors');
        /* return response([
            'data' => 'okey!',
        ]); */
    }

    /* Remove the specified resource from storage */
    public function destroy($id)
    {
        Author::findorfail($id)->delete();
        return redirect()->route('authors');
    }
}
