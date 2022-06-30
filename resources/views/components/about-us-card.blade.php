<div class="flex flex-col justify-center items-center">
    @if (array_key_exists('image', $miembro))
        <img src={{ asset('/images/about-us/' . $miembro['image'] . '.png') }} alt="{{ $miembro['name'] }}"
            class="w-8/12 rounded-full">
    @else
        <img src={{ asset('/images/about-us/Portrait_Placeholder.png') }} alt="{{ $miembro['name'] }}"
            class="w-8/12 rounded-full">
    @endif
    <div>
        <h2 class="my-3"> {{ $miembro['name'] }}</h2>
    </div>
    <div class="flex items-center justify-between">
        @foreach ($miembro['socials'] as $red => $redLink)
            @if ($red == 'envelope')
                <a href="mailto:{{ $redLink }}" class="mx-1" target="_blank" rel="noreferrer">
                    <i class="fa-solid fa-envelope fa-xl"></i>
                </a>
            @elseif($red == 'user')
                <a href="{{ $redLink }}" class="mx-1" target="_blank" rel="noreferrer">
                    <i class="fa-solid fa-user fa-lg"></i>
                </a>
            @else
                <a href="{{ $redLink }}" class="mx-1" target="_blank" rel="noreferrer">
                    <i class="fa-brands fa-{{ $red }} fa-xl"></i>
                </a>
            @endif
        @endforeach
    </div>
</div>
