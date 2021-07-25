<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="hidden space-x-8 sm:-my-px sm:flex mb-10">
                <x-nav-link href="/register" :active="request()->get('type') != 'manager'">
                    {{ __('Employee') }}
                </x-nav-link>
                <x-nav-link href="/register?type=manager" :active="request()->get('type') == 'manager'">
                    {{ __('Manager') }}
                </x-nav-link>                
            </div>
          
            <input type="hiden" name="type" value="{{request()->get('type', 'employee')}}">

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Company -->
            @if (request()->get('type') == 'manager')
            <div  class="mt-4">
                <x-label for="company" :value="__('Company')" />

                <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" />
            </div>
            @endif

            <!-- Manager Email Address -->
            @if (request()->get('type') != 'manager')
            <div class="mt-4">
                <x-label for="parent_email" :value="__('Manager Email')" />

                <x-input id="parent_email" class="block mt-1 w-full" type="email" name="parent_email" :value="old('parent_email')"  />
            </div>
            @endif

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
