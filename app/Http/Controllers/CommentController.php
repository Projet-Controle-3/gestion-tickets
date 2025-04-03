<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'messages' => 'required|string|max:1000',
            'response_id' => 'required|exists:responses,id'
        ]);
    
        Comment::create([
            'utilisateur_id' => Auth::user()->id,
            'messages' => $request->messages,
            'response_id' => $request->response_id,
        ]);
    
        return redirect()->route('tickets.my-tickets')->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->utilisateur_id) {
            return redirect()->route('tickets.my-tickets')->with('error', 'Vous ne pouvez pas supprimer ce commentaire.');
        }

        $comment->delete();

        return back()->with('success_delete', 'Commentaire supprimé avec succès.');
    }
}
