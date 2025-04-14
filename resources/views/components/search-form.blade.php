<div {{ $attributes->merge(['class' => 'flex justify-center']) }}>
    <form action="{{ route('posts.index') }}" method="GET">
        <div class="flex justify-between items-center border ps-[10px] pe-[15px] bg-white rounded-full w-[400px] border-gray-300">
            <input type="text" class="border-none w-full rounded-full text-gray-700 focus:ring-0"  name="search" value="{{ request('search') }}" placeholder="Search posts...">
            <button 
                type="submit"
                class="active:bg-gray-400 active:translate-y-[2px]">
                <img src="{{ asset('storage/images/search.png') }}"
                class="w-[20px]" alt="">
            </button>
        </div>
    </form>
</div>