<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::get();

        return response()->json([
            'success' => true,
            'data' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;

        if ($author->save())
            return response()->json([
                'success' => true,
                'data' => $author->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Author not added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $author->toArray()
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
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
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 400);
        }

        $updated = $author->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Author can not be updated'
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 400);
        }

        if ($author->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Author can not be deleted'
            ], 500);
        }
    }
}
