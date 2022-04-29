<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->fullName()) }}
        </h2>
    </x-slot>
    <div style="display: flex; flex-direction: column; align-items: center;" class="py-12 bg-white">
<div style="" class="bg-white shadow overflow-hidden w-3/6 sm:rounded-lg mb-5 p-5">
    <div class="px-4 py-5 sm:px-6">

        <a href="{{route('users.edit', $user->id)}}">
    <button class="bg-orange-300 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
        Editer profil
    </button>
</a>
    </div>
    <div class="px-4 py-5 sm:px-6 flex w-full 	">
        <h2 class=" mr-10 text-lg leading-6 font-medium text-gray-900">Nom: {{ $user->lastname }}</h2>

        @if(isset($user->avatar))
        <img class="w-1/6 m-4" src="{{ asset('storage/avatar/'.$user->avatar->chemin) }}" alt="">
        @else
        <img class="w-1/6 m-4" src="https://spo.princeton.edu/sites/spo/files/styles/panopoly_image_original/public/people/placeholder.png?itok=SDrkEjGD" alt="">
        @endif
    </div>
    <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900"> Prenom: {{ $user->firstname }}</h2>
      </div>
    <div class="px-4 py-5 sm:px-6">
        <p class="text-lg leading-6 font-medium text-gray-900">Role: {{ $user->getRoleNames()->first() }}</p>
      </div>

       <div class="px-4 py-5 sm:px-6">
        <p class="text-lg leading-6 font-medium text-gray-900">Mail: {{ $user->email }}</p>
      </div>
      <div class="px-4 py-5 sm:px-6">
          @if(isset($user->entreprise))
        <p class="text-lg leading-6 font-medium text-gray-900">Entreprise: {{ $user->entreprise->nom }}</p>
        @endif
        @if(isset($user->cv))
        <a href="{{ route('users.download.cv', $user->id) }}">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Telecharger CV
        </button>
        </a>
        @endif

      </div>
  </div>
  <a href="{{ route('users.index') }}">All Users</a>
</div>
    </div>

</x-app-layout>


