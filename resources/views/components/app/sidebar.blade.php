<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Sidebar -->
    <div
        id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false"
        x-cloak="lg"
    >

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('dashboard') }}">
                <svg width="32" height="32" viewBox="0 0 32 32">
                    <defs>
                        <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                            <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%" />
                            <stop stop-color="#A5B4FC" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                            <stop stop-color="#38BDF8" stop-opacity="0" offset="0%" />
                            <stop stop-color="#38BDF8" offset="100%" />
                        </linearGradient>
                    </defs>
                    <rect fill="#6366F1" width="32" height="32" rx="16" />
                    <path d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z" fill="#4F46E5" />
                    <path d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z" fill="url(#logo-a)" />
                    <path d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z" fill="url(#logo-b)" />
                </svg>
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['dashboard'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['dashboard'])){{ 'hover:text-slate-200' }}@endif" href="/dashboard">
                            <div class="flex items-center">
                                <i class="fas fa-layer-group"></i>
                                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    @if (auth()->user()->role=='admin')
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['users'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['users'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('users.index') }}">
                            <div class="flex items-center">
                                <i class="fas fa-users"></i>
                                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">User</span>
                            </div>
                        </a>
                    </li>
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['bill-type'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['bill-type'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('type.index') }}">
                            <div class="flex items-center">
                                <i class="fas fa-box"></i>
                                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Master Bill</span>
                            </div>
                        </a>
                    </li>
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['bill'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['bill'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('bill.index') }}">
                            <div class="flex items-center">
                                <i class="fas fa-wallet"></i>
                                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bill Data</span>
                            </div>
                        </a>
                    </li>
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['bill-approve'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['bill-approve'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('bill.approve') }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fas fa-file-invoice"></i>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bill Approve</span>
                                </div>
                                <span class="inline-block px-2 py-1 text-xs font-semibold leading-none text-white bg-blue-100/60 rounded-full">{{ \App\Models\Bill::where('status','submited')->count()}}</span>
                            </div>
                        </a>
                    </li>
                    @else
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['bill-paid'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['bill-paid'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('bill.paid') }}">
                            <div class="flex items-center">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bill Paid</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>