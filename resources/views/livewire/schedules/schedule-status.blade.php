<div wire:poll="updateStatus">
    @php
        $status = match ($status) {
            0 => ['Pending', 'border-yellow-400', 'text-yellow-400'],
            1 => ['Processing...', 'border-blue-400', 'text-blue-400'],
            2 => ['Completed', 'border-green-400', 'text-green-400'],
            default => ['Overdue', 'border-red-400', 'text-red-400'],
        };
    @endphp

    <span class="rounded-xl {{ $status[1] }} border-[1px] py-1 px-3 {{ $status[2] }}">
        {{ $status[0] }}
    </span>
</div>