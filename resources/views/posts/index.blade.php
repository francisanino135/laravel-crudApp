<x-app-layout>

    <x-auth-session-status class="mt-[15px]" :status="session('status')" />

    <x-input-error :messages="$errors->all()" class="mt-[15px]" id="error-message" />

    <div class="py-12 px-5">
        <div class="flex gap-16">

            <aside x-data="{
                isCollapsed: false,
                isHeightCollapsed: false,
                isMobile: window.innerWidth <= 900,
                updateCollapse() {
                    this.isMobile = document.documentElement.clientWidth <= 900;
                    this.isCollapsed = this.isMobile;
                },
                toggleSidebar() { this.isCollapsed = !this.isCollapsed },
                toggleMenu() {
                    if (this.isMobile) {
                        this.isHeightCollapsed = !this.isHeightCollapsed; // Toggle height only  
                    }
                }
            }" x-init="updateCollapse();
            window.addEventListener('resize', () => updateCollapse())"
                :class="{
                    'w-[85px] pb-[25px]': isCollapsed,
                    'w-[270px] h-[calc(100vh-30px)] ': !
                        isCollapsed,
                    'h-[70px]': isMobile && isHeightCollapsed,
                    'h-[82vh]': isMobile && !
                        isHeightCollapsed
                }"
                class="sidebar">
                <!-- Sidebar header -->
                <header class="sidebar-header">
                    <div :class="isMobile ? 'opacity-0' : 'opacity-100'">
                        <x-application-logo class="fill-[#FF3F18] w-[46px] h-[46px] object-contain rounded-[50%]" />
                    </div>
                    <button @click="toggleSidebar()"
                        :class="{ 'translate-y-[65px] rotate-[180deg]': isCollapsed, 'opacity-0': isMobile }"
                        class="sidebar-toggler">
                        <span class="material-symbols-rounded text-[1.75rem]">chevron_left</span>
                    </button>

                    <button @click="toggleMenu()"
                        :class="{
                            'opacity-100 translate-x-[-2px] pointer-events-auto': isMobile,
                            'opacity-0 pointer-events-none':
                                !isMobile,
                            'rotate-[360deg] translate-y-[-15px]': isMobile && isHeightCollapsed
                        }"
                        class="toggler absolute right-[22px] h-[35px] w-[35px] bg-white border-none rounded-[8px] flex items-center justify-center transition duration-300 ease-in-out hover:bg-[#dde4fb] menu-toggler">
                        <span class="material-symbols-rounded">menu</span>
                    </button>
                </header>
                <nav class="sidebar-nav" style="relative">
                    <!-- Primary top nav -->
                    <ul :class="{ 'translate-y-[65px]': isCollapsed && !isMobile, 'translate-y-0': isMobile || !isCollapsed }"
                        class="nav-list flex flex-col gap-[4px] py-0 px-[15px] list-none translate-y-[15px] primary-nav transition duration-300 ease-in-out">
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    dashboard
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Dashboard
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] z-50 rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Dashboard
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    calendar_today
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Calendar
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Calendar
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    notifications
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Notifications
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Notifications
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    group
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Team
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Teams
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    insert_chart
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">
                                    Analytics
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Analytics
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    star
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">
                                    Bookmarks
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Bookmarks
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">settings
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Settings
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Settings
                            </span>
                        </li>
                    </ul>
                    <!-- Secondary bottom nav -->
                    <ul :class="{ 'mt-0': isMobile, 'mt-[58px]': !isMobile }"
                        class="nav-list flex flex-col gap-[4px] px-[15px] list-none translate-y-[15px] secondary-nav">
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    account_circle
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Profile
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Profile
                            </span>
                        </li>
                        <li class="nav-item relative group">
                            <a href="#" class="nav-link">
                                <span
                                    :class="isMobile && isHeightCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' :
                                        'transition duration-300 ease-in-out opacity-100'"
                                    class="nav-icon material-symbols-rounded">
                                    logout
                                </span>
                                <span
                                    :class="isCollapsed ?
                                        'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''"
                                    class="nav-label">Logout
                                </span>
                            </a>
                            <span
                                class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                                Logout
                            </span>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="flex gap-16 border w-full">
                <div class="w-full max-w-[650px] min-w-[400px] border">
                    <a href="{{ url('create-post') }}">
                        <span
                            class="material-symbols-rounded text-[40px] text-white bg-[#4B006E] rounded-full p-[2px] shadow-[0_0_10px_rgba(0,0,0,0.2)] hover:bg-gray-300">
                            add_circle
                        </span> </a>

                    @if ($posts->isEmpty())
                        <div class="mt-[20px]">
                            <h2 class="text-[15px] ps-[10px] py-[2px]">No posts found.</h2>
                        </div>
                    @else
                        @foreach ($posts as $post)
                            <div
                                class="bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] mt-[20px] z-0 text-white rounded-[16px] pb-[15px]">
                                <!-- Profile Picture -->
                                <div class="ps-[20px] pt-[20px]">
                                    <div class="flex items-center justify-between pe-[15px] mb-[20px]">
                                        <div class="flex items-center">
                                            @if ($post->user->profile_picture)
                                                <img src="{{ url($post->user->profile_picture) }}" alt="Profile Picture"
                                                    alt="Profile Picture"
                                                    class="rounded-full w-[40px] h-[40px] me-[10px] border-[2px] border-gray-200 shadow-sm">
                                            @else
                                                <p>No profile picture</p>
                                            @endif
                                            {{-- @if ($user->profile_picture)
                                            <img src="{{ $user->profile_picture }}" alt="Profile Picture"
                                                class="rounded-full border-[2px] border-gray-300 shadow-md w-[35px] h-[35px]">
                                            @else
                                            <p>No profile picture</p>
                                            @endif --}}

                                            <div class="font-bold text-md">
                                                {{ $post->user->name ?? 'Unknown User' }}
                                                <div class="text-white/50 text-xs">
                                                    {{ $post->user->created_at->format('M d, Y') ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                        @if (auth()->user()->id == $post->user_id)
                                            <div>
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button>
                                                            <span
                                                                class="material-symbols-rounded p-2 rounded-full hover:bg-gray-300 ">more_vert</span>
                                                        </button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('posts.edit', $post->id) }}"
                                                            class="block w-full px-4 py-2 text-start text-sm text-white transition duration-300 ease-in-out rounded-[8px] hover:bg-white hover:text-[#151A2D]">
                                                            {{ __('Edit') }}
                                                        </a>

                                                        <form action="{{ route('posts.destroy', $post->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-4 py-2 text-start text-sm text-white transition duration-300 ease-in-out rounded-[8px] hover:bg-white hover:text-[#151A2D]">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown>
                                            </div>
                                        @else
                                        @endif

                                    </div>
                                    <!-- Post Title and Author -->
                                    <div>
                                        <h3 class="text-[30px] font-bold mb-[35px]">
                                            {{ $post->title }}
                                        </h3>
                                        <div class="text-[15px] ">
                                            {{-- <p>{!! $post->body !!}<span class=" active:text-purple-400 active:translate-y-[1px] active:underline"> <a
                                                        href="{{ route('posts.show', $post->id) }}">...Read
                                                        more</a></span></p> --}}
                                            <p class="flex gap-2">{!! $post->body !!}<a
                                                    class="font-semibold active:text-purple-400 active:translate-y-[1px] active:underline"
                                                    href="{{ route('posts.show', $post->id) }}">...Read
                                                    more</a></p>

                                        </div>
                                    </div>

                                    @if (isset($post->media) && is_array($post->media))
                                        <div class="mt-[20px] flex flex-wrap gap-[15px]">
                                            @foreach ($post['media'] as $mediaItem)
                                                @if (Str::endsWith($mediaItem, ['.png', '.jpg', '.jpeg', '.gif']))
                                                    <!-- Display image -->
                                                    <img src="{{ asset('storage/' . $mediaItem) }}"
                                                        alt="Uploaded Image"
                                                        class="max-w-[200px] border-4 border-gray-800">
                                                @elseif(Str::endsWith($mediaItem, ['.mp4', '.mov', '.avi']))
                                                    <!-- Display video -->
                                                    <video controls class="max-w-[200px] rounded-md">
                                                        <source src="{{ asset('storage/' . $mediaItem) }}"
                                                            type="video/mp4">
                                                    </video>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                                <div class="flex justify-end items-center mt-[10px] me-[20px] gap-3">
                                    <p>{{ $post->comments_count }}</p>
                                    <img src="{{ asset('storage/images/comment.png') }}" class="w-[20px] invert"
                                        alt="">
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>

                <div x-data="{
                    isCollapsed: false,
                    isSmall: window.innerWidth <= 1000,
                    updateCollapse() {
                        this.isSmall = document.documentElement.clientWidth <= 1000;
                        this.isCollapsed = this.isSmall;
                    },
                    toggleMenu() { this.isCollapsed = !this.isCollapsed },
                }" x-init="updateCollapse();
                window.addEventListener('resize', () => { $data.updateCollapse(); })"
                    :class="{ 'w-[50px]': isCollapsed, 'w-full max-w-[350px]': !isCollapsed }" class="grid-table">
                    <div :class="{ 'opacity-0': isCollapsed, 'opacity-100': !isCollapsed }" class="header-grid">Name
                    </div>
                    <div :class="{ 'opacity-0': isCollapsed, 'opacity-100': !isCollapsed }" class="header-grid"># of
                        Posts
                    </div>
                    @foreach ($users as $user)
                        <div :class="{ 'opacity-0': isCollapsed, 'opacity-100': !isCollapsed }" class="cell-grid"><img src="{{ url($user->profile_picture) }}" alt="Profile Picture"
                            alt="Profile Picture"
                            class="rounded-full w-[40px] h-[40px] me-[10px] border-[2px] border-gray-200 shadow-sm">
                            {{ $user->name }}</div>
                        <div :class="{ 'opacity-0': isCollapsed, 'opacity-100': !isCollapsed }" class="cell-grid">
                            {{ $user->posts_count }}</div>
                    @endforeach

                </div>

            </div>


        </div>
    </div>




</x-app-layout>
