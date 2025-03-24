<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Ticket;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $categories = Categorie::all();

        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|in:en_cours,fermés,en_attente',
            'category_id' => 'required|exists:categories,id',
        ]);

        Ticket::create([
            'utilisateur_id' => Auth::user()->id,
            'sujet' => $request->input('sujet'),
            'description' => $request->description,
            'statut' => $request->statut,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
    //
    }
}
