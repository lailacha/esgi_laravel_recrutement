<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Contrat;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = DB::table('offres')->paginate();
        return view('offres.index', ['offres' => $offres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_contrats = Contrat::all();
        return view('offres.create', ['type_contrats' => $type_contrats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'type_contrat' => 'required',
            'poste' => 'required|string|max:60',
            'description' => 'required|string|max:2500',
            'salaire_min_annuel' => 'lt:salaire_max_annuel|nullable',
            'salaire_max_annuel' => 'gte:salaire_min_annuel|nullable',
        ]);

        isset($request->teletravail) ? $request->teletravail = 1 : $request->teletravail = 0;
        isset($request->lettre_motivation) ? $request->lettre_motivation = 1 : $request->lettre_motivation = 0;

        $offre = Offre::create([
            'entreprise_id' => $user->entreprise->id,
            'recruteur_id' => $user->id,
            'contrat_id' => $request->type_contrat,
            'poste' => $request->poste,
            'description' => $request->description,
            'salaire_min_annuel' => $request->salaire_min_annuel ?? null,
            'salaire_max_annuel' => $request->salaire_max_annuel ?? null,
            'lettre_motivation' => $request->lettre_motivation,
            'teletravail' => $request->teletravail,
        ]);
        return redirect()->intended(route('offres.show', [$offre->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        return view('offres.show', ['offre' => $offre]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function showCandidatures(Offre $offre)
    {
       /* $candidatures = DB::table('candidatures')
            ->where('offre_id', '=', $offre->id)
            ->paginate();*/
        $candidatures = Candidature::all();
        return view('offres.showCandidatures', ['candidatures' => $candidatures, 'offre' => $offre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
        //
    }
}
