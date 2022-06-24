<x-app-layout>
    <x-jet-authentication-card class="my-6">
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="mt-4" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <h2 class="text-2xl font-bold">Crear Cuenta</h2>
                <h3 class="text-lg">Complete el formulario para registrarse en el sistema</h3>
                <span class="text-gray-600 text-sm">Los campos marcados con (*) son obligatorios</span>
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nombre (*)') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="surname" value="{{ __('Apellido (*)') }}" />
                <x-jet-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')"
                    required autofocus autocomplete="surname" />
            </div>

            <div class="mt-4">
                <x-jet-label for="country" value="{{ __('Pais') }}" />
                <x-jet-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required
                    autofocus autocomplete="country" />
                    @php
                     $path = (base_path().'\resources\json\countries.json');
                     $countries = json_decode(file_get_contents($path),true);
                     //print_r ( $countries);
                
                   @endphp

                   <select>

                   @foreach($countries['countries'] as $country)
                   <option>{{$country['name']}}</option>
                   @endforeach
                   </select>
                   
                   
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"> </script>
                <!-- <script type="text/javascript" src="..\..\json\countries.json"> </script> -->

                <x-jet-label for="dni" value="{{ __('DNI (*)') }}" />
                <x-jet-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')"
                    required autofocus autocomplete="dni" />
            </div>

            <div class="mt-4">
                <x-jet-label for="country" value="{{ __('País (*)') }}" />
                <x-jet-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"
                    required autofocus autocomplete="country" />
            </div>



            <div class="mt-4">
                <x-jet-label for="province" value="{{ __('Provincia (*)') }}" />
                <x-jet-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')"
                    required autofocus autocomplete="province" />
            </div>

            <div class="mt-4">
                <x-jet-label for="city" value="{{ __('Ciudad (*)') }}" />
                <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                    required autofocus autocomplete="city" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo Electrónico (*)') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña (*)') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirme su Contraseña (*)') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya se encuentra registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
