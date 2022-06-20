<div {{ $attributes->merge(['class' => 'flex items-center justify-center bg-awesome py-[0.75rem] px-[1.25rem] rounded-t-[0.25rem] h-[72px]']) }}>
    <h2 {{ $attributes->merge(['class' => ' text-[1.5rem] md:text-[2rem] text-center text-white-ghost ']) }}>
        {{ $slot }}
    </h2>
</div>
