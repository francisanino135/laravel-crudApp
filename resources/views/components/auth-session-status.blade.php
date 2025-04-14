@props(['status'])

@if ($status)
<div x-data="{ visible: true }" x-show="visible" x-init="setTimeout(() => visible = false, 2000)" >
    <div class="flex items-center justify-center"> <!-- Parent container -->
        <div id="flash-message" {{ $attributes->merge(['class' => 'bg-white border border-gray-300 shadow-md rounded-full px-[10px] py-[15px] inline-flex font-medium text-[#258D42] text-[15px]']) }}>
            {{ $status }}
        </div>
    </div>
</div>
@endif