@aware(['component'])
<div class="flex flex-col">
  <p class="text-[1rem]">{{$presentation->title}}</p>
  <button class="flex" wire:click="$emit('showMoreInformationModal', '{{$value}}')">
    <p class="underline text-blue-400 text-[0.8rem]" >
      (Más Informacion)
    </p>
  </button>
</div>