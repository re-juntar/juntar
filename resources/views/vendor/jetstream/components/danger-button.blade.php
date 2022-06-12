<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-awesome border border-transparent rounded-md font-semibold text-xs text-white-ghost uppercase tracking-widest hover:bg-fogra-dark focus:outline-none focus:border-awesome focus:ring focus:ring-awesome active:bg-awesome disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
