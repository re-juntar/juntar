<button
    {{ $attributes->merge(['class' => 'bg-awesome text-white-ghost border-none py-[0.5rem] px-[1rem] text-[1.25rem] rounded-[0.3rem] hover:bg-fogra-dark transition ease-in-out delay-50']) }}>
    {{ $slot }}
</button>
