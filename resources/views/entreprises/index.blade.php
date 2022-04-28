<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Les entreprises présentent sur lookingforajob
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   Liste des entreprises
                   <br><br>

                    <ul>
                        @foreach($entreprises as $entreprise)
                            <li>
                                <p style="font-size: 2rem; display: inline;">{{$entreprise->nom}}</p>
                                <p style="display: inline;">[<a href="{{ route('entreprises.show', $entreprise)}}">En savoir plus</a>]</p>
                            </li>
                            <li>{{ $entreprise->description }}</li>

                        @endforeach
                        <br>
                        {{$entreprises->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
