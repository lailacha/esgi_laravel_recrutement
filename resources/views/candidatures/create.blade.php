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
                    <form method="POST" action="{{ route('candidatures.store', $offre) }}" enctype="multipart/form-data">
                    @csrf
                        <p>CV à ajouter</p>

                        <br><br>
                        <p>Letrre de motivation à ajouter</p>

                        <br><br>
                    <!-- CV -->
                        <div class="mt-4">
                            <x-label for="cv_insert" :value="__('Cv')" />

                            <x-input id="cv_insert" class="block mt-1 w-full" type="file" name="cv_insert" />
                            <p>
                                Utiliser mon CV par défaut <input type="checkbox" name="cv_checkbox">
                            </p>
                        </div>

                        <!-- Lettre de motivation -->
                        @if($offre->lettre_motivation == 1)
                            <div class="mt-4">
                                <label for="lettre_motivation_insert">Lettre de motivation</label>
                                <input type="file" name="lettre_motivation_insert" accept="image/pdf">
                            </div>
                        @endif

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
