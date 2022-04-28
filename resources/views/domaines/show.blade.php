<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Domaine : {{ $domaine->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <p style="font-size: 2rem;">{{ $domaine->titre  }}</p>
                    </div>
                    <div>
                        @foreach($domaine->entreprises as $entreprise)
                           <p>
                               <a href="{{ route('entreprises.show', $entreprise->id) }}">{{$entreprise->nom}}</a>
                           </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
