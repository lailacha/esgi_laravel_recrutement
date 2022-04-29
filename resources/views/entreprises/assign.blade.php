<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-indigo-600 leading-tight mb-10">
                        Ajouter un coéquipier
                    </h2>
                    <form method="POST" action="{{ route('entreprises.assign') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Mail -->
                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input class="block mt-1 w-full" required type="email" name="mail" />
                        </div>

                            <!-- Entreprise -->
                                <input class="block mt-1 w-full" required type="hidden" name="entreprise_id"  value={{$entreprise->id}} />

                        <div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-4 bg-indigo-600 p-3 rounded text-white">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
