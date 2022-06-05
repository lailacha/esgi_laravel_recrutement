<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Domaine;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Services\EntrepriseService;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EntrepriseRequest;

class EntrepriseController extends Controller
{


    private $mediaService;

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
        $entreprises = Entreprise::paginate(10);


        return view('entreprises/index', ['entreprises' => $entreprises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entreprises/create', ['domaines' => Domaine::all(), 'pays' => Pays::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntrepriseRequest $request)
    {

        if($request->hasFile('logo')){
            $logo = $this->mediaService->saveRessourceGetInstance($request,'logo','logo');
        }

        $data =  array_merge(Arr::except($request->validated(), ['logo']), ['media_id' => $logo->id]);

        $entreprise = Entreprise::create($data);

        Auth::user()->entreprise_id = $entreprise->id;
        Auth::user()->save();

        return redirect()->route('entreprises.show', $entreprise);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        return view('entreprises/show', ['entreprise' => $entreprise]);
    }

    public function assignForm(Entreprise $entreprise)
    {
        return view('entreprises.assign', ['entreprise' => $entreprise]);
    }

    public function assignUser(Request $request)
    {
        $user = User::where('email', $request->mail)->get()->first();

        if(!$user) {
            return redirect()->back()->with('error', 'Ajout impossible');
        }

        if($user->entreprise_id != null) {
            return redirect()->back()->with('error', 'Cet utilisateur est déjà affecté à une entreprise');
        }

        $user->entreprise_id = $request->entreprise_id;
        $user->save();

        return redirect()->route('entreprises.show', ['entreprise' => $user->entreprise_id])->with('success', 'Utilisateur assigné');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
