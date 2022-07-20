<?php
    $randomized_members_array = $this->randomize_members($miembrosv2);
?>
<div class="pb-[70px]">
    <h2 class="mb-[1rem]">Equipo Programación Web Avanzada - 2022 (Juntar v2) </h2>
    <hr class="my-[1rem]">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach ($randomized_members_array as $miembro)
            <x-about-us-card :miembro="$miembro" />
        @endforeach
    </div>
</div>
