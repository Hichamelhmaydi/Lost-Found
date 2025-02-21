<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Categories;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::all(); 
    
        return view('welcome', compact('annonces'));
    }
    public function dashboard()
    {
        $user = auth()->user();
        $annonces = Annonce::where('user_id', $user->id)->paginate(10);
        return view('dashboard', compact('annonces'));
    }
    public function create()
    {
        $categories = Categories::all();  
        return view('annonces.create', compact('categories'));  
    }
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    
        $request->validate([
            'titre' => 'required|max:20',
            'description' => 'required',
            'lieu' => 'required|max:20',
            'photo' => 'required|image|mimes:jpeg,png,jpg',
            'email' => 'required|email|max:40',
            'tele' => 'required|max:40',
            'status' => 'required|in:en attend,trouve,perdu',
            'categorie_id' => 'required|exists:categories,id',
        ]);
    
        $imageName = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }
    
        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'photo' => $imageName,
            'email' => $request->email,
            'tele' => $request->tele,
            'status' => $request->status,
            'categorie_id' => $request->categorie_id,
            'user_id' => auth()->id(), // تحديد user_id أثناء الإنشاء
        ]);
        
    
        return redirect()->route('annonces.index');
    }
    public function show($id)
    {
        $annonce = Annonce::findOrFail($id);
        return view('annonces.show', compact('annonce'));
    }
    public function edit($id)
    {
        $annonce = Annonce::findOrFail($id);
        $categories = Categories::all();
        return view('annonces.edit', compact('annonce', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|max:100',
            'description' => 'required',
            'lieu' => 'required',
            'photo' => 'nullable|image',
            'email' => 'required|email',
            'tele' => 'required',
            'status' => 'required|in:en attend,trouve,perdu',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $annonce = Annonce::findOrFail($id);
        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : $annonce->photo;

        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'photo' => $photoPath,
            'email' => $request->email,
            'tele' => $request->tele,
            'status' => $request->status,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('annonces.index');
    }
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return redirect()->route('annonces.index');
    }
}
