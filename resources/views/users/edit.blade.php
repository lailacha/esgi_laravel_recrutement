<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form name="seance-form" method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data"  class="w-full max-w-lg">
                    <div class="flex flex-wrap flex-col mb-6">
                    <h1 class="m-10">Modification de l'utilisateur: {{$user->fullName()}}</h1>
                    @if(isset($user->avatar))
                    <img class="w-1/6 m-4" src="{{ asset('storage/avatar/'.$user->avatar->chemin) }}" alt="">
                    @else
                    <img class="w-1/6 m-4" src="https://spo.princeton.edu/sites/spo/files/styles/panopoly_image_original/public/people/placeholder.png?itok=SDrkEjGD" alt="">
                    @endif
                        <div class="w-full md:w-1/3 px-3 mt-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Prénom
                            </label>
                            <div class="relative">
                                <input type="text" name="firstname" value="{{ $user->firstname }}">
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 px-3 mt-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Nom
                            </label>
                            <div class="relative">
                                <input type="text" name="lastname" value="{{ $user->lastname }}">
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-2">
                            {{-- If user has permission (admin) --}}
                            <div class="w-full md:w-1/3 px-3 mt-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Roles
                                </label>
                                <div class="relative">
                                    <select name="role"
                                        class="block   bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        selected={{$user->role->id}}>
                                        @foreach ($roles as $role)
                                            <option value={{ $role->name }}
                                                @if($user->hasRole($role->name)))
                                                selected
                                            @endif > {{ $role->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- // --}}

                            @csrf




                            </div>



                            {{-- If user has permission (isUser authenticated) --}}

                            <!-- Avatar -->
                            <div class="ml-5 w-full mt-3 mb-6 md:mb-0">
                                <x-label for="avatar" :value="__('Avatar')" />

                                <input id="avatar" class="block mt-1 w-full" type="file" name="avatar" />


                            <!-- CV -->
                                <x-label for="cv" :value="__('Cv')" />

                                <input id="cv" class="block mt-1 w-full" type="file" name="cv" />
                                {{-- // --}}

                            </div>




                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mt-3 mb-6 md:mb-0">
                                    <button type="submit"
                                        class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Modifier
                                    </button>
                                </div>
                </form>
        </div>
    </div>
</div>
    <a href="{{route('users.show', $user->id)}}">Retour au profil</a>

</x-app-layout>
