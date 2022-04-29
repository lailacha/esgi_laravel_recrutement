<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            Les offres disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($offres as $offre)
                        <div>
                            <a href="{{ route('offres.show', $offre->id) }}" style="font-size: 2rem;">{{ $offre->poste  }}</a>
                            @if(isset($offre->salaire_min_annuel) && isset($offre->salaire_max_annuel))
                                <p style="font-style: italic; color: grey;">{{ $offre->salaire_min_annuel . ' to ' . $offre->salaire_max_annuel . ' €' }}</p>
                            @endif
                            <p>{{ strlen($offre->description > 350) ? substr($offre->description, 0, 350).'...' : ''  }}</p>
                        </div>
                    @endforeach
                </div>
                <div>
                    {{ $offres->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
