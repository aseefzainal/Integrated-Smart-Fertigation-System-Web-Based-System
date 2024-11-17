<div
    class="border-[1px] rounded-lg border-gray-200 dark:border-gray-600 md:h-96 shadow-md bg-white overflow-y-auto overscroll-none no-scrollbar flex flex-col">
    <div class="flex justify-between items-center py-2 px-3 text-sm sticky top-0 z-10 bg-white shadow-sm">
        <h3 class="text-sm sm:text-base">Input</h3>
        <div class="flex items-center space-x-2">
            @if (!$inputs->isEmpty())
                <span
                    class="text-xs sm:text-sm text-gray-900 flex items-center justify-center py-1.5 px-3 sm:py-2 cursor-pointer rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700"
                    wire:click="toggleControlType">
                    {{-- Switch to ManualControl --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3 sm:size-5 text-gray-600 sm:text-gray-400 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                    {{ $controlText }}
                </span>
                <div wire:click="$set('showInputModal', true)"
                    class="p-1.5 sm:p-2 cursor-pointer rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-4 sm:size-5 text-gray-400">
                        <path fill-rule="evenodd"
                            d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>
    </div>

    <x-my-layouts.toast></x-my-layouts.toast>

    <!-- Warning modal -->
    <div x-data="{ showModal: false }" x-show="showModal" id="deleteModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 right-0 left-0 z-50 h-full flex justify-center items-center bg-gray-500 bg-opacity-75"
        style="display: none;">
        <div class="relative p-4 w-full max-w-md h-auto" wire:loading.class="sm:w-1/5" wire:target="toggleStatus">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div wire:loading.remove wire:target="toggleStatus">
                    <button wire:click="closeModal(@entangle('inputId'), @entangle('originalStatus'))" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    {{-- <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg> --}}
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to toggle the status?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="closeModal(@entangle('inputId'), @entangle('originalStatus'))" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        {{-- <button @click="$wire.toggleStatus" type="button"  --}}
                        <button wire:click="toggleStatus" type="button"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </div>
                </div>
                {{-- <div wire:loading role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"> --}}
                <div wire:loading wire:target="toggleStatus" role="status">
                    <svg aria-hidden="true"
                        class="w-8 h-8 inline text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    {{-- <span class="sr-only">Loading...</span> --}}
                    <span class="text-lg ml-3">Processing...</span>
                    {{-- <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Loading... --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Crud modal -->
    <div x-data="{ showInputModal: @entangle('showInputModal') }" x-show="showInputModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 right-0 left-0 z-50 h-full flex justify-center items-center bg-gray-500 bg-opacity-75"
        style="display: none;">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto overflow-y-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex items-center mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    {{-- <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Data Sensor
                </h3> --}}
                    {{-- Tabs --}}
                    {{-- <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700"> --}}
                    <ul class="flex flex-wrap -mb-px text-sm font-medium">
                        <li class="me-2">
                            <button wire:click="$set('tab', 1)"
                                class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab == 1 ? 'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">Set
                                Duration</button>
                        </li>
                        <li class="me-2">
                            <button wire:click="$set('tab', 2)"
                                class="inline-block p-4 border-b-2 rounded-t-lg {{ $tab == 2 ? 'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'border-transparent  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}">
                                Rename Input</button>
                        </li>
                    </ul>
                    {{-- </div> --}}
                    <button type="button" wire:click="closeCrudModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        @if ($tab == 1)
                            @foreach ($inputs as $input)
                                @if ($input->type === 'auto')
                                    <div>
                                        <label for="input_{{ $input->pivot->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $input->name }}</label>
                                        <input type="number" name="input_{{ $input->pivot->id }}"
                                            id="input_{{ $input->pivot->id }}"
                                            wire:model.live="inputValues.{{ $input->pivot->id }}.duration"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        {{-- Display error for this specific input --}}
                                        @error('inputValues.' . $input->pivot->id . '.duration')
                                            <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            @endforeach
                        @elseif ($tab == 2)
                            @foreach ($inputs as $input)
                                <div>
                                    <label for="input_{{ $input->pivot->id }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $input->name }}</label>
                                    <input type="text" name="input_{{ $input->pivot->id }}"
                                        id="input_{{ $input->pivot->id }}"
                                        wire:model.live="inputValues.{{ $input->pivot->id }}.custom_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                                    {{-- Display error for this specific input --}}
                                    @error('inputValues.' . $input->pivot->id . '.custom_name')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="flex items-center">
                        <button wire:loading.remove wire:taget="save" type="submit"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Save Change
                        </button>
                        <button wire:loading wire:taget="save" disabled type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                            <svg aria-hidden="true" role="status"
                                class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            Loading...
                        </button>
                        {{-- <button type="button" wire:click="closeCrudModal"
                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Cancel
                    </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (!$inputs->isEmpty())
        {{-- @dump($showInputModal, $showModal) --}}
        {{-- <div class="grid sm:grid-cols-2 gap-3 px-3 pt-2 pb-3" {{ $showInputModal || $showModal ? '' : 'wire:poll' }}> --}}
        <div class="grid lg:grid-cols-2 gap-3 px-3 pt-2 pb-3">
            @foreach ($inputs as $input)
                @if ($input->type === $controlType)
                    <div wire:key="input-{{ $input->pivot->id }}"
                        class="flex shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3 items-start justify-between">
                        <div class="space-y-1 sm:space-y-2">
                            <h3 class="text-sm sm:text-base">{{ $input->pivot->custom_name }}</h3>
                            @if ($input->type === 'auto')
                                <p class="text-[11px] sm:text-xs text-slate-600 mr-2">
                                    Duration: {{ $input->pivot->duration }} Minutes
                                </p>
                            @endif
                            <p
                                class="text-[11px] sm:text-xs text-slate-600 {{ $input->type === 'auto' ? '' : 'mr-2' }}">
                                {{-- Note: {{ $input->description }} --}}
                                Note: This input will automatically turn off when the soil is
                                moist{{ $input->pivot->duration > 0 ? ' or after ' . $input->pivot->duration . ' minutes.' : '.' }}
                            </p>
                        </div>
                        @livewire('inputs.switch-button', ['inputId' => $input->pivot->id, 'status' => $input->pivot->status], key($input->pivot->id))
                        {{-- <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="switch-{{ $input->pivot->id }}"
                                name="switch-{{ $input->pivot->id }}" class="sr-only peer"
                                {{ $input->pivot->status === 1 ? 'checked' : '' }}
                                wire:click="openModal({{ $input->pivot->id }})">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                            </div>
                        </label> --}}
                        {{-- @if ($input->type === 'auto')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="ml-1 -mr-2 cursor-pointer size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            @endif
                        </div> --}}
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="col-span-2 sm:h-full flex flex-col justify-center items-center text-center bg-slate-100 text-xs sm:text-base text-slate-700 py-5 px-2">
            <p>No inputs have been added to this project yet.
            </p>
            <p class="mt-2">Please contact an administrator to add inputs to this project.
            </p>
        </div>
    @endif
</div>
