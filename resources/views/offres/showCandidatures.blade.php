<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600  leading-tight">
            Les candidatures pour le poste de {{ $offre->poste }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @foreach($candidatures as $candidature)
                            <p style="font-size: 2rem;">{{ $candidature->candidat->firstname . ' ' . $candidature->candidat->firstname }}</p>
                            <p>{{ $candidature->candidat->email }}</p>
                            <a href="{{ route('candidatures.download.cv', $candidature) }}">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Telecharger CV
                                </button>
                            </a>
                            @if(isset($candidature->lettreMotivation))
                                <a href="{{ route('candidatures.download.lettre_motivation', $candidature) }}">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Telecharger la lettre de motivation
                                    </button>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
