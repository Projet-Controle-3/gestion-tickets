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
        $tickets = Ticket::with('category')->get();
        return view('tickets.index', compact('tickets'));
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
            'category_id' => 'required|exists:categories,id',
            'piece_jointe' => 'nullable|file|max:5120',
        ]);
        
        $filePath = null;
         // Verification de fichier d'input piece jointes
        if ($request->hasFile('piece_jointe')) {
        $filePath = $request->file('piece_jointe')->store('pieces_jointes', 'public');
        }

        Ticket::create([
            'utilisateur_id' => Auth::user()->id,
            'sujet' => $request->input('sujet'),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'piece_jointe' => $filePath,

        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $categories = Categorie::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|in:en_cours,fermés,en_attente',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'sujet' => $request->sujet,
            'description' => $request->description,
            'statut' => $request->statut,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket supprimé avec succès.');
    }
}
