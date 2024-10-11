<div
    class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-[22rem] shadow-lg bg-white overflow-y-auto overscroll-none no-scrollbar flex flex-col">
    <div class="flex justify-between items-center py-2 px-3 text-sm sticky top-0 z-10 bg-white shadow-sm">
        <h3>Input</h3>
        <span class="text-blue-600 cursor-pointer hover:underline" wire:click="toggleControlType">
            {{-- Switch to ManualControl --}}
            {{ $controlText }}
        </span>
    </div>
    {{-- @dump($inputs) --}}
    @if (!$inputs->isEmpty())
    {{-- @if (!empty($inputs)) --}}
        <div class="grid grid-cols-2 gap-3 px-3 pt-2 pb-3">
            @foreach ($inputs as $input)
                {{-- @if ($input->type === 'auto') --}}
                    <div wire:key="input-{{ $input->pivot->id }}" class="flex shadow-[0_0_5px_2px_rgb(0_0_0/0.1)] rounded-lg p-3 items-start">
                        <div>
                            <h3>{{ $input->pivot->custom_name }}</h3>
                            <p class="text-xs text-slate-600 mt-2 mr-2">Note:
                                {{ $input->description }}
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="input_{{ $input->pivot->id }}" class="sr-only peer"
                                {{ $input->pivot->status === 1 ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                            </div>
                        </label>
                    </div>
                {{-- @endif --}}
            @endforeach
        </div>
    @else
        <div class="col-span-2 h-full flex flex-col justify-center items-center bg-slate-100">
            <p>No inputs have been added to this project yet.
            </p>
            <p class="mt-2">Please contact an administrator to add inputs to this project.
            </p>
        </div>
    @endif
</div>
