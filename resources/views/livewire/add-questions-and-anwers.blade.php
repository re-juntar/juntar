@aware(['component'])
<div>
    @if (count($answer) !== 0)
        <div class="">
            <button wire:click="$emit('showPyRModal', '{{$value}}')"
                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                @lang('Respuestas')
            </button>
        </div>
    @else
        @if ($preIncriptionDate)
            <p class="flex justify-center text-black">Sin Respuestas</p>
        @endif
    @endif
</div>