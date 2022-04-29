<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>
    <div style="display: flex; flex-direction: column; align-items: center;" class="py-12 bg-white">

        <ul>
            @foreach ($users as $user )

                <li>
                    <a href="{{route('users.show', $user->id)}}">
                    {{ $user->fullName()}}</li>
                </a>

            @endforeach
        </ul>

        <div class="d-flex justify-content-center mt-3">
            {!! $users->links() !!}
        </div>
    </div>
</x-app-layout>
