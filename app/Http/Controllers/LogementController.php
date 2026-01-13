<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\Clients;

use Illuminate\Http\Request;
use App\Mail\LocateurContactMail;
use Illuminate\Support\Facades\Mail;


class LogementController extends Controller
{
    /**
     * Afficher le dashboard selon le rôle.
     */
    public function index()
    {
        if (auth()->user()->role === 'locateur') {
            $logements = auth()->user()->logements;
            return view('dashboard', compact('logements'));
        }

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Stocker un nouveau logement.
     */
    public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|string',
        'adresse' => 'nullable|string|max:255',
        'ville' => 'nullable|string|max:255',
        'nb_chambres' => 'required|integer|min:1',
        'prix' => 'required|numeric',
        'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
    ]);

    $data = $request->all();
    $images = [];

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('logements', 'public');
            $images[] = $path;
        }
    }

    $data['photos'] = json_encode($images);

    auth()->user()->logements()->create($data);

    return redirect()->route('dashboard')->with('success', 'Logement ajouté avec succès !');
}

    /**
     * Afficher un logement spécifique.
     */
    public function show(Logement $logement)
    {
        return view('dashboard', compact('logement'));
    }

    /**
     * Afficher le formulaire pour modifier un logement.
     */
    public function edit(Logement $logement)
    {
        $logements = auth()->user()->logements;
        return view('dashboard', compact('logement', 'logements'));
    }

    /**
     * Mettre à jour un logement existant.
     */
    public function update(Request $request, Logement $logement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'nb_chambres' => 'required|integer|min:1',
            'prix' => 'required|numeric',
        ]);

        $logement->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Logement mis à jour avec succès !');
    }

    /**
     * Supprimer un logement.
     */
    public function destroy(Logement $logement)
    {
        $logement->delete();

        return redirect()->route('dashboard')->with('success', 'Logement supprimé avec succès !');
    }
    public function publish($id)
    {
        $logement = Logement::findOrFail($id);
        $logement->published = true;
        $logement->save();

        return redirect()->back()->with('success', 'pblication fait avec success');
    }
    public function unpublish($id)
    {
        $logement = Logement::findOrFail($id);
        $logement->published = 0;
        $logement->save();

        return redirect()->back()->with('success', 'annulation de pblication fait avec success');
    }


    public function regarderPlus($id)
    {
        $logement = Logement::findOrFail($id);
        return view('annonces.show', compact('logement'));
    }

    public function search(Request $request)
    {
        $query = Logement::query()->where('published', true);

        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $logements = $query->get();

        return view('welcome', compact('logements'));
    }


    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $locateur = Clients::findOrFail($id);

        Mail::to($locateur->email)->send(new LocateurContactMail($request->message));

        return back()->with('success', 'Message envoyé avec succès !');
    }

}
