<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   Détails de l'entreprise :
                   
                   <br><br>

                <ul>
                    <li>
                        Nom de l'entreprise : {{$entreprise->nom}} <br>
                        Identification : {{$entreprise->identification}} <br>
                        Adresse : {{$entreprise->adresse}} <br>
                        Code Postal : {{$entreprise->code_postal}} <br>
                        Domaine : [<a href="#">{{$entreprise->domaine->titre}}</a>] <br>
                        Description : {{$entreprise->description}}<br><br>
                        Coordonnées : <br>
                        Mail : {{$entreprise->mail}} <br>
                        Téléphone : {{$entreprise->tel}} <br>
                        Ville : {{$entreprise->ville}} <br>
                        Pays : {{$entreprise->pays->nom}}

                    </li>
                </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>