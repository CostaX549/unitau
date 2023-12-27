@props(['name', 'title'])

<div x-data="{ show : false , name : '{{ $name }}' }" 
    x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)" 
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false" 
    x-transition
    style="display:none;" class="fixed z-50 inset-0 "
    
    >
    
    {{-- Gray Background --}}
    <div  x-data x-on:click="show = false"  class="fixed inset-0 bg-gray-300 opacity-40"></div>

    {{-- Modal Body --}}
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:650px">
        @if (isset($title))
            <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                <div class="text-xl text-gray-800">{{ $title }}</div>
                <button x-data x-on:click="show = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="p-4">
            
            {{ $body }}
        </div>
    </div>


</div>