<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
            'description' => 'nullable|string|max:255', 
        ]);
    
        Commentaire::create([
            'annonce_id' => $id,
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
            'description' => $request->description, 
        ]);
    
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }
    
}
