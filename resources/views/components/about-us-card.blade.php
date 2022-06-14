<div class="card-about-us w-10/12 sm:w-2/5 lg:w-1/5 mb-[1.5rem] bg-fogra-darkish text-white-ghost">
    <div {{ $attributes->merge(['class' => 'card-header py-[0.75rem] px-[1.25rem] bg-gradient-cards animate-gradient-anima bg-[length:600%_600%]']) }}>
        {{ $nombre }}
    </div>
    <div class="card-body p-[1.25rem]">
        <p class="mb-[1rem]"> {{ $descripcion }} </p>
    </div>
    <div class="card-footer text-center py-[0.75rem] px-[1.25rem]">
        <a href="{{ $link }}">💌</a>
    </div>
</div>
