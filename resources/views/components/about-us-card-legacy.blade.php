<div class="card-about-us bg-fogra-darkish text-white-ghost h-52">
    <div @class([
        'card-header py-[0.75rem] px-[1.25rem] bg-fogra-dark' => true,
        'bg-gradient-cards animate-gradient-anima bg-[length:600%_600%]' =>
            $miembro['isDev'],
    ])>
        {{ $miembro['nombre'] }}
    </div>
    <div class="card-body p-[1.25rem] h-3/4 flex flex-col justify-between">
        <p class="mb-[1rem]"> {{ $miembro['mensajes'][array_rand($miembro['mensajes'])] }} </p>
        @if($miembro['link'] != '')
            <div class="flex items-center justify-center">
                <a href="{{ $miembro['link'] }}" class="text-center py-[0.75rem] px-[1.25rem]"><i class="fa-solid fa-envelope"></i></a>
            </div>
        @endif
    </div>
</div>
