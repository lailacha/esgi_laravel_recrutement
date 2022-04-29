<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Entreprise : {{ $entreprise->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                <div class="p-6 w-3/6 bg-white border-b border-gray-200">
                   <p style="font-size: 2rem;">Détails de l'entreprise :</p>
                   <img class="w-1/6 m-4" src="{{ asset('storage/entreprises_logo/'.$entreprise->logo->chemin) }}" alt="">
                   <br>

                <ul>
                    <li>
                        Nom de l'entreprise : {{$entreprise->nom}} <br>
                        Identification : {{$entreprise->identification}} <br>
                        Adresse : {{$entreprise->adresse}} <br>
                        Code Postal : {{$entreprise->code_postal}} <br>
                        Domaine : [<a href="{{ route('domaines.show', $entreprise->domaine->id) }}">{{$entreprise->domaine->titre}}</a>] <br>
                        Description : {{$entreprise->description}}<br><br>
                        Coordonnées : <br>
                        Mail : {{$entreprise->mail}} <br>
                        Téléphone : {{$entreprise->tel}} <br>
                        Ville : {{$entreprise->ville}} <br>
                        Pays : {{$entreprise->pays->nom}}

                    </li>
                </ul>


                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Auth::user()->entreprise->id == $entreprise->id)
                    <h1>Membres:</h1>
                    <ul>
                    @foreach ($entreprise->recruteurs as $recruteur )

                    <li>{{$recruteur->fullName()}}</li>
                    @endforeach
                    </ul>

                    <div class="flex items-center justify-end mt-4">
                    <a href="{{route('entreprises.assign.form', $entreprise->id)}}">
                        <button class="ml-4 bg-indigo-600 p-3 rounded text-white">
                           Ajouter des coéquipiers
                        </button>
                    </a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
