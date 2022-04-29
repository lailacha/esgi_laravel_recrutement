<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Les offres disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('offres.store', ['user' => Auth::user()]) }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Type de contrat -->
                        <div class="mt-4">
                            <label for="type_contrat">Type de contrat</label>
                            <p>
                                <select name="type_contrat" id="type_contrat" required class="block mt-1 w-full">
                                    <option value=""></option>
                                    @foreach($type_contrats as $contrat)
                                        <option value="{{ $contrat->id }}">{{ $contrat->nom }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>

                        <!-- Poste -->
                        <div class="mt-4">
                            <label for="poste">Intitulé du poste</label>
                            <input id="poste" class="block mt-1 w-full" type="text" name="poste" required />
                        </div>


                        <!-- description -->
                        <div class="mt-4">
                            <label for="description">Description de l'offre</label>

                            <textarea id="description" class="block mt-1 w-full"
                                     name="description"
                                      required
                            ></textarea>
                        </div>

                        <!-- Salaire minimum -->
                        <div class="mt-4">
                            <label for="salaire_min_annuel">Salaire minimum annuel (sans décimale et en €)</label>

                            <input id="salaire_min_annuel" class="block mt-1 w-full"
                                     type="number"
                                     name="salaire_min_annuel" />
                        </div>

                        <!-- Salaire maximum -->
                        <div class="mt-4">
                            <label for="salaire_max_annuel">Salaire maximum annuel (sans décimale et en €)</label>

                            <input id="salaire_max_annuel" class="block mt-1 w-full"
                                   type="number"
                                   name="salaire_max_annuel" />
                        </div>

                        <!-- Infos -->
                        <div class="mt-4">
                            <fieldset>
                                <legend>Informations concernant l'offre</legend>
                                <div>
                                    <label for="teletravail">Télétravail</label>
                                    <input type="checkbox" id="teletravail" name="teletravail">
                                </div>
                                <div>
                                    <label for="lettre_motivation">Lettre de motivation attendue</label>
                                    <input type="checkbox" id="lettre_motivation" name="lettre_motivation">
                                </div>
                            </fieldset>
                        </div>
                        <div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-4">
                                Créer l'offre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
