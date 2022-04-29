<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MediaController;

class CandidatureController extends Controller
{
    private MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Offre $offre)
    {
        return view('candidatures.create', ['offre' => $offre]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Offre $offre)
    {
        $request->validate([
            'cv_insert' => 'file|mimes:pdf',
            'lettre_motivation_insert' => 'file|mimes:pdf',
        ]);

        $user = Auth::user();

        if($request->hasFile('lettre_motivation_insert')) {
            $lettre_motivation = $this->mediaService->saveRessourceGetInstance($request, 'lettre_motivation', 'lettre_motivation');
        }

        if($request->hasFile('cv_insert')) {
            $cv = $this->mediaService->saveRessourceGetInstance($request, 'cv_insert', 'cv');
        }else{
            $cv_id = $user->cv_id;
        }
        $candidature = Candidature::create([
            'candidat_id' => $user->id,
            'offre_id' => $offre->id,
            'lettre_motivation_id' => $lettre_motivation->id ?? null,
            'cv_id' => $cv->id ?? $cv_id,
        ]);

        return redirect()->intended(route('candidatures.show', [$candidature->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function show(Candidature $candidature)
    {
        return view('candidatures.show', ['candidature' => $candidature]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidature $candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidature $candidature)
    {
        //
    }

    public function downloadCV(Candidature $candidature)
    {
        return MediaController::downloadMedia($candidature->cv_id, 'cv');
    }

    public function downloadLM(Candidature $candidature)
    {
        return MediaController::downloadMedia($candidature->cv_id, 'lettre_motivation');
    }
}
