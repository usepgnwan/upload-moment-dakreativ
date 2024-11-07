<section class="w-full relative " id="dashboard">
    <!-- drawer component -->
    <div id="drawer-disabled-backdrop" class="fixed top-[64px] left-0 h-screen p-4 overflow-y-auto transition-transform  bg-white border-r dark:border-r-gray-700 border-r-slate-300 max-lg:w-64 sm:w-1/5 dark:bg-gray-800 z-20 ">
        <div class="w-full flex flex-wrap justify-center p-2 hidden">
            {{-- <div class="w-full flex justify-center mx-auto ">
                @if (auth()->user() )
                <img id="avatarButton" class="w-24 h-w-24 rounded-full cursor-pointer " src="{{ auth()->user() }} " alt="User">
                @else
                <span class="size-14 icon-[solar--user-circle-bold]"></span>
                @endif
            </div>
            <div class="text-wrap">
                {{auth()->user()->name}}
            </div>--}}
        </div>
        <h5 id="drawer-disabled-backdrop-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>

        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <x-partials.dashboard.side-link href="{{route('account.dashboard')}}" :active="request()->routeIs('account.dashboard')" :icon="'icon-[streamline--pie-chart-solid]'">
                    <span class="ms-3">Dashboard</span>
                </x-partials.dashboard.side-link>

                <x-partials.dashboard.side-link href="{{route('account.pelanggan')}}" :active="request()->routeIs('account.pelanggan') " :icon="'icon-[ph--user-list]'">
                    <span class="ms-3">Pelanggan</span>
                </x-partials.dashboard.side-link>

                <x-partials.dashboard.side-link :multi="'true'"  href="" :active="request()->routeIs('account.master*')" :icon="'icon-[material-symbols--database-outline]'" class=" w-full ">
                    <span class="ms-3" > <x-slot name="title">Master</x-slot> </span>
                    <!-- multi link -->
                    <x-slot name="link">
                        <x-partials.dashboard.side-link href="{{route('account.master.paket')}}" :active="request()->routeIs('account.master.paket*')"   class=" pl-11 ">
                            <span class="ms-3">Paket</span>
                        </x-partials.dashboard.side-link>
                        <x-partials.dashboard.side-link href="{{route('account.master.event')}}" :active="request()->routeIs('account.master.event*')"   class=" pl-11 ">
                            <span class="ms-3">Event</span>
                        </x-partials.dashboard.side-link>
                    </x-slot>
                </x-partials.dashboard.side-link>
            </ul>
        </div>
    </div>
</section>
