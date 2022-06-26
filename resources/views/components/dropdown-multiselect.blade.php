<div>
    {{-- Functionality used here lives in the dropdown() function on displayInputs.js --}}
    <div x-data="dropdown()" x-init="loadOptions()" class="flex">
        {{ $slot }}
        <div class="flex relative w-64">
            <div class="flex flex-col items-center relative">
                {{-- Input with arrows to click and open dropdown --}}
                <div x-on:click="open" class="w-full ">
                    <div class=" p-1 flex border border-gray-200 bg-white-ghost rounded">
                        <div class="flex flex-auto flex-wrap">
                            <div x-show="selected.length <= 3" class="flex-1">
                                <input placeholder="Seleccione una opci&oacute;n"
                                    class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                    x-bind:value="getValue()"
                                    @input.debounce="updateUsersList($event)"
                                >
                            </div>
                        </div>
                        <div
                            class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">

                            <button type="button" x-show="isOpen() === true" x-on:click="open"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
    c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
    " />
                                </svg>
                            </button>

                            <button type="button" x-show="isOpen() === false" @click="close"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
    c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
    L17.418,6.109z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Dropdown options to select from --}}
                <div class="w-full px-4">
                    <div x-show.transition.origin.top="isOpen()"
                        class="absolute shadow top-100 bg-white-ghost z-40 w-full left-0 rounded max-h-select overflow-y-auto svelte-5uyqqj"
                        x-on:click.away="close">
                        <div class="flex flex-col w-full">
                            {{-- Options arr is filitered by 'show' property and shows only 5 results max --}}
                            <template x-for="(option,index) in options.filter(option => option.show == true)" :key="'option'+index">
                                {{-- Selecting an input calls select(), which adds the option to selected array and populates hidden inputs --}}
                                <template x-if="index <= 4">
                                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-slate-200"
                                        @click="select(option.id, $event)">
                                        <div x-bind:class="option.selected ? 'border-awesome' : ''"
                                            class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                            <div class="w-full items-center flex">
                                                <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chips of selected users, with funcionality to click and delete the item form the selected array --}}
        <div class="flex">
            <template x-for="(option,index) in selected" :key="options[option].value">
                <div
                    x-on:click="remove(index,option)"
                    class="flex justify-center items-center m-1 cursor-pointer font-medium py-1 px-2 bg-white-ghost rounded-full border border-black ">
                    <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                        options[option]" x-text="options[option].text"></div>
                    <div class="flex flex-auto flex-row-reverse">
                            <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                            C14.817,13.62,14.817,14.38,14.348,14.849z" />
                            </svg>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
