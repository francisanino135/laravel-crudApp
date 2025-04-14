@props(['messages', 'id' => null]) {{-- Add an optional 'id' prop --}}

@if ($messages)
    <div x-data="{ visible: true }" x-show="visible" x-init="setTimeout(() => visible = false, 2000)">
        <div class="flex items-center justify-center"> <!-- Parent container -->
            <ul {{ $attributes->merge(['id' => $id, 'class' => 'bg-white border border-gray-300 shadow-md rounded-full px-[5px] py-[10px] inline-flex font-medium text-center text-[#FE2E13] text-[15px]']) }}>
                @foreach ((array) $messages as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif