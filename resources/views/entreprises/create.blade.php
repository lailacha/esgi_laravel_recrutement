<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-indigo-600 leading-tight mb-10">
                        Ajouter mon entreprise
                    </h2>
                    <form method="POST" action="{{ route('entreprises.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Type de domaine -->
                        <div class="mt-4">
                            <label for="type_contrat">Domaine</label>
                            <p>
                                <select name="domaine_id" required class="block mt-1 w-full">
                                    @foreach($domaines as $domaine)
                                        <option value="{{ $domaine->id }}">{{ $domaine->titre }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>

                        <!-- Nom -->
                        <div class="mt-4">
                            <label for="nom">Nom</label>
                            <input class="block mt-1 w-full" type="text" name="nom" required />
                        </div>


                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description">Description de l'entreprise</label>

                            <textarea class="block mt-1 w-full"
                                     name="description"
                                      required
                            ></textarea>
                        </div>


                        <!-- Mail -->
                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input class="block mt-1 w-full"
                            type="email"
                            name="mail" />
                        </div>

                          <!-- Tel -->
                          <div class="mt-4">
                            <label for="tel">Telephone (fixe)</label>
                            <input class="block mt-1 w-full"
                            type="tel"
                            name="tel" />
                        </div>


                        <!-- Adresse -->
                        <div class="mt-4">
                            <label for="adresse">Adresse</label>
                            <input class="block mt-1 w-full"
                            type="text"
                            name="adresse" />
                        </div>

                          <!-- CP -->
                          <div class="mt-4">
                            <label for="cp">CP</label>
                            <input class="block mt-1 w-full"
                            type="text"
                            name="code_postal" />
                        </div>

                          <!-- Ville -->
                          <div class="mt-4">
                            <label for="ville">Ville</label>
                            <input class="block mt-1 w-full"
                            type="text"
                            name="ville" />
                        </div>

                           <!-- Pays -->
                           <div class="mt-4">
                            <label for="pays_id">Pays</label>
                            <p>
                                <select name="pays_id" required class="block mt-1 w-full">
                                    @foreach($pays as $pay)
                                        <option value="{{ $pay->id }}">{{ $pay->nom }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>


                        <!-- Numéro Identification -->
                        <div class="mt-4">
                            <label for="identification">Numéro d'identification</label>

                            <input  class="block mt-1 w-full"
                                     type="text"
                                     name="identification" />
                        </div>

                        <!-- Logo -->
                        <div class="mt-4">
                            <label for="Logo">Logo</label>

                            <input class="block mt-1 w-full"
                                   type="file"
                                   name="logo" />
                        </div>

                        <div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-4 bg-indigo-600 p-3 rounded text-white">
                                Créer l'entreprise
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
