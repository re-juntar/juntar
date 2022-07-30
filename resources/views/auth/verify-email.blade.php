<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Antes de continuar. Debe verificar por unica vez  su correo electrónico clickeando en el link que le hemos enviado. Si no recibió el correo, haciendo click en el siguiente boton `re-enviar correo ` le enviaremos otro encantadamente.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Un nuevo link de verificación ha sido enviado al correo electrónico provisto en su configuración de perfil.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Re-enviar Correo Electrónico de Verificación') }}
                    </x-jet-button>
                </div>
            </form>

        </div>
    </x-jet-authentication-card>
</x-guest-layout>
