<div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 mb-2 sm:mb-4 w-full text-gray-900 font-medium text-sm">
        <div wire:click="$set('tab', 1)"
            class="rounded-lg bg-white p-3 sm:p-4 shadow-md cursor-pointer hover:bg-slate-50 border-[1px] border-gray-200 dark:border-gray-600">
            <h4 class="mb-2 sm:mb-3 text-gray-500">Number of Users</h4>
            <div class="flex items-center">
                <div class="p-2 rounded-full border-[1px] border-gray-300 bg-slate-50 mr-2">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                      </svg>                           --}}
                    {{-- <svg class="size-4 text-black dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-width="1" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>                           --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </div>
                <span class="text-base sm:text-2xl">{{ $totalUsers }}</span>
            </div>
        </div>
        <div wire:click="$set('tab', 2)"
            class="rounded-lg bg-white p-3 sm:p-4 shadow-md cursor-pointer hover:bg-slate-50 border-[1px] border-gray-200 dark:border-gray-600">
            <h4 class="mb-2 sm:mb-3 text-gray-500">Number of Projects</h4>
            <div class="flex items-center">
                <div class="p-2 rounded-full border-[1px] border-gray-300 bg-slate-50 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>
                </div>
                <span class="text-base sm:text-2xl">{{ $totalProjects }}</span>
            </div>
        </div>
        <div wire:click="$set('tab', 3)"
            class="rounded-lg bg-white p-3 sm:p-4 shadow-md cursor-pointer hover:bg-slate-50 border-[1px] border-gray-200 dark:border-gray-600">
            <h4 class="mb-2 sm:mb-3 text-gray-500">Total Orders</h4>
            <div class="flex items-center">
                <div class="p-2 rounded-full border-[1px] border-gray-300 bg-slate-50 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </div>
                <span class="text-base sm:text-2xl">0</span>
            </div>
        </div>
        <div wire:click="$set('tab', 4)"
            class="rounded-lg bg-white p-3 sm:p-4 shadow-md cursor-pointer hover:bg-slate-50 border-[1px] border-gray-200 dark:border-gray-600">
            <h4 class="hidden sm:block mb-3 text-gray-500">Outstanding Notification Costs</h4>
            <h4 class="sm:hidden mb-2 text-gray-500">Total Outstanding</h4>
            <div class="flex items-center">
                <div class="p-2 rounded-full border-[1px] border-gray-300 bg-slate-50 mr-2">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                      </svg>    --}}
                    <svg class="size-4 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                    </svg>
                </div>
                <span class="text-base sm:text-2xl">RM{{ number_format($totalOutstandingBill, 2) }}</span>
            </div>
        </div>
    </div>

    @if ($tab == 1)
        <div wire:init="loadUserList">
            @livewire('dashboard.user-list')
        </div>
    @else
        <div wire:init="loadCostOverview">
            @livewire('dashboard.cost-overview')
        </div>
    @endif
</div>
