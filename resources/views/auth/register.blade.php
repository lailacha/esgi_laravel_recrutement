<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- firstname -->
            <div>
                <x-label for="firstname" :value="__('Firstname')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>


            <!-- lastname -->
            <div>
                <x-label for="lastname" :value="__('Lastname')" />

                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>


                <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>


            <div class="mt-4 mb-4">
                <x-label for="role" :value="__('Je suis un recruteur')" />

                <x-input id="role" class="block mt-1 w-full" type="radio" name="role" value="recruteur" required />

                <x-label for="role" :value="__('Je cherche un emploi')" />

                <x-input id="role" class="block mt-1 w-full" type="radio" name="role" value="candidat" required />

            </div>


            <!-- Avatar -->
            <div>
                <x-label for="avatar" :value="__('Avatar')" />

                <x-input id="avatar" class="block mt-1 w-full" type="file" name="avatar" />
            </div>


                <!-- CV -->
                <div>
                    <x-label for="cv" :value="__('Cv')" />

                    <x-input id="cv" class="block mt-1 w-full" type="file" name="cv" />
                </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
