<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $animes = Anime::get();

        return response()->json([
            'success' => true,
            'data' => $animes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'title' => 'required',
            'description' => 'required',
            'author_id' => 'required'
        ]);

        $anime = new Anime();
        $anime->title = $request->title;
        $anime->description = $request->description;

        if ($request->episodes) {
            $anime->episodes = $request->episodes;
        }

        if ($request->genre) {
            $anime->genre = $request->genre;
        }

        $anime->author_id = $request->author_id;

        if ($anime->save())
            return response()->json([
                'success' => true,
                'data' => $anime->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(Anime $anime)
    {
        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime not found '
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $anime->toArray()
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(Anime $anime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anime $anime)
    {
        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        $updated = $anime->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Anime can not be updated'
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anime $anime)
    {

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime not found'
            ], 400);
        }

        if ($anime->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Anime can not be deleted'
            ], 500);
        }
    }
}
