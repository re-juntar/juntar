<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-awesome border border-transparent rounded-md font-semibold text-xs text-white-ghost uppercase tracking-widest hover:bg-fogra-dark active:bg-awesome focus:outline-none focus:border-awesome focus:ring focus:ring-awesome disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
