<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600  leading-tight">
            Les offres disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex justify-between">
                              <p style="font-size: 2rem;">{{ $offre->poste  }}</p>
                        @if($offre->entreprise->id === Auth::user()->entreprise->id)
                        <form action="{{route('offres.delete', $offre->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                        @endif
                        </div>

                        @if(isset($offre->salaire_min_annuel) && isset($offre->salaire_max_annuel))
                            <p style="font-style: italic; color: grey;">{{ number_format($offre->salaire_min_annuel) . ' to ' . number_format($offre->salaire_max_annuel) . ' €' }}</p>
                        @endif
                        <p>{{ strlen($offre->description > 350) ? substr($offre->description, 0, 350).'...' : ''  }}</p>
                    </div>
                    <br>
                    <br>
                    <div>
                        <p><a href="{{ route('entreprises.show', $offre->entreprise) }}">{{ $offre->entreprise->nom }}</a></p> <!-- ajouter la route entreprises.show !-->
                        <p style="display: inline;">Son domaine : {{ $offre->entreprise->domaine->titre }}</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p style="display: inline; font-style: italic; color: grey;">
                            <a href="#">Voir d'autres entreprises dans ce domaine</a></p>
                    </div>
                    <br>
                    <div>
                        <p>
                            <a href="#" style="color:grey;font-style: italic;border: 0.2rem solid">Postuler</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
