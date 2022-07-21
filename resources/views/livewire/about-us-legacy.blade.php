<?php
    $randomized_members_array = $this->randomize_members($miembros);
?>
<div>
    <h2 class="mb-[1rem]">Equipo Programación Web Avanzada - 2020 (Juntar v1) </h2>
    <hr class="my-[1rem]">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach ($randomized_members_array as $miembro)
            <x-about-us-card-legacy :miembro="$miembro" />
        @endforeach
        @foreach ($profesoras as $profesora)
            <x-about-us-card-legacy :miembro="$profesora" />
        @endforeach
    </div>
</div>
