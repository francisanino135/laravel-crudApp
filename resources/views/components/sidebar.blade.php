
    <aside 
        x-data="{ 
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
        }" 
        x-init="updateCollapse(); window.addEventListener('resize', () => updateCollapse())"        
        :class="{ 'w-[85px] pb-[25px]': isCollapsed, 'w-[270px] h-[calc(100vh-30px)] ': !isCollapsed, 'h-[70px]': isMobile && isHeightCollapsed, 'h-[82vh]': isMobile && !isHeightCollapsed }"
        class="sidebar bg-[#4B006E] rounded-[16px] sticky top-3 transition-all duration-500 ease-in-out"
        >
        <!-- Sidebar header -->
        <header class="sidebar-header relative flex py-[25px] px-[20px] items-center justify-between">
            <div :class="isMobile ? 'opacity-0' : 'opacity-100'">
                <x-application-logo
                    class="fill-[#FF3F18] w-[46px] h-[46px] object-contain rounded-[50%]" />
            </div>
            <button @click="toggleSidebar()"
                :class="{'translate-y-[65px] rotate-[180deg]': isCollapsed, 'opacity-0': isMobile}"
                class="toggler absolute right-[22px] h-[35px] w-[35px] bg-white border-none rounded-[8px] flex items-center justify-center transition duration-300 ease-in-out hover:bg-[#dde4fb] sidebar-toggler">
                <span class="material-symbols-rounded text-[1.75rem]">chevron_left</span>
            </button>

            <button @click="toggleMenu()"
                :class="{ 'opacity-100 translate-x-[-2px] pointer-events-auto': isMobile, 'opacity-0 pointer-events-none': !isMobile, 'rotate-[360deg] translate-y-[-15px]': isMobile && isHeightCollapsed }"  
                class="toggler absolute right-[22px] h-[35px] w-[35px] bg-white border-none rounded-[8px] flex items-center justify-center transition duration-300 ease-in-out hover:bg-[#dde4fb] menu-toggler">
                <span class="material-symbols-rounded">menu</span>
            </button>
        </header>
        <nav class="sidebar-nav" style="relative">
            <!-- Primary top nav -->
            <ul
            :class="{'translate-y-[65px]': isCollapsed && !isMobile, 'translate-y-0': isMobile || !isCollapsed }"
                class="nav-list flex flex-col gap-[4px] py-0 px-[15px] list-none translate-y-[15px] primary-nav transition duration-300 ease-in-out">
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'" 
                            class="nav-icon material-symbols-rounded">
                            dashboard
                        </span>
                        <span 
                            :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
                            class="nav-label">Dashboard
                        </span>
                    </a>
                    <span
                        class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] z-50 rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                        Dashboard
                    </span>
                </li>
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'" 
                            class="nav-icon material-symbols-rounded">
                            calendar_today
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
                            class="nav-label">Calendar
                        </span>
                    </a>
                    <span
                        class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                        Calendar
                    </span>
                </li>
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'"
                            class="nav-icon material-symbols-rounded">
                            notifications
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
                            class="nav-label">Notifications
                        </span>
                    </a>
                    <span
                        class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                        Notifications
                    </span>
                </li>
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'"
                            class="nav-icon material-symbols-rounded">
                            group
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
                            class="nav-label">Team
                        </span>
                    </a>
                    <span
                        class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                        Teams
                    </span>
                </li>
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'" 
                            class="nav-icon material-symbols-rounded">
                            insert_chart
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
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
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'"
                            class="nav-icon material-symbols-rounded">
                            star
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
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
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'" 
                            class="nav-icon material-symbols-rounded">settings
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
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
            <ul
                :class="{'mt-0': isMobile, 'mt-[58px]': !isMobile}"
                class="nav-list flex flex-col gap-[4px] px-[15px] list-none translate-y-[15px] secondary-nav">
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'"
                            class="nav-icon material-symbols-rounded">
                            account_circle
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
                            class="nav-label">Profile
                        </span>
                    </a>
                    <span
                        class="nav-tooltip pointer-events-none absolute text-[#151A2D] py-[6px] px-[12px] rounded-[8px] opacity-0 bg-white top-[1px] left-[calc(100%+25px)] whitespace-nowrap shadow-lg group-hover:opacity-100">
                        Profile
                    </span>
                </li>
                <li class="nav-item relative group">
                    <a href="#"
                        class="nav-link text-white flex gap-[12px] items-center py-[12px] px-[15px] transition duration-300 ease-in-out rounded-[8px] hover:text-[#151A2D] hover:bg-white">
                        <span 
                            :class="isMobile && isHeightCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : 'transition duration-300 ease-in-out opacity-100'"
                            class="nav-icon material-symbols-rounded">
                            logout
                        </span>
                        <span :class="isCollapsed ? 'transition duration-300 ease-in-out opacity-0 pointer-events-none' : ''" 
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