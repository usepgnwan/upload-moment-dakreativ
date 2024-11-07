@props(['check' => null])
<header class='flex dark:bg-gray-800 bg-white dark:text-white dark:border-b-gray-700 text-black  border-b border-b-slate-300 max-lg:py-4 max-lg:px-4 sm:px-10 sticky font-[sans-serif] min-h-[70px] tracking-wide  top-0 z-50  '
    id="header">
    <div class='flex flex-wrap items-center gap-5 w-full'>

        <!-- front web -->
        @if ($check == 'dashboard')
            <!-- dashboard header -->
            <span>
            <!-- style="background-image: url('{{ asset('asset/img/home/teacher2.png') }}')" -->
                <a href="" @click.prevent="Livewire.navigate('')"><img src="{{ asset('assets/1.png') }}" alt="logo"  class='lg:w-36 max-lg:w-20 mr-4' /> </a>

                <button  class='button-menu max-lg:right-4 dark:bg-transparent fixed top-2 lg:left-[12.6rem]  z-[100] rounded-full   p-3 w-max- h-opened mt-[2px]'>

                    <span class="icon-[line-md--close-to-menu-alt-transition] size-6 delay-75 h-open  hidden dark:fill-white "></span>
                    <span class="icon-[line-md--menu-to-close-alt-transition] size-6 delay-75 fill dark:fill-white  h-close fill-whitemt-[3px] "></span>

                </button>
            </span>
        @endif
        <div class='flex ml-auto min-w-[30px] mr-6 gap-3 max-lg:mr-12 z-10'>
            <span class="icon-[ion--search-outline] size-5 cursor-pointer fill-gray-400 my-auto max-lg:ml-auto web-mode dark:text-white"></span>
            <!-- <span class="icon-[line-md--moon-loop] size-4 cursor-pointer fill-gray-400 my-auto max-lg:ml-auto"></span> -->
            <span class="size-5 cursor-pointer fill-gray-400 my-auto max-lg:ml-auto  dark-button">  </span>
            <!-- <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-7 h-w-7 rounded-full cursor-pointer " src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="User"> -->
            <!-- Dropdown menu -->


            @auth

            <div x-data="{ open: false }" class="relative inline-block  ">
            @if (auth()->user() )
            <img   @click="open = !open" @click.outside="open = false" class="w-7 h-w-7 rounded-full cursor-pointer my-auto max-lg:ml-auto object-cover" src="http://127.0.0.1:8000/assets/users/2222.png" alt="User">

            @else
                <span @click="open = !open" @click.outside="open = false"
                    class="mt-2 dropdown-toggle-button-user icon-[solar--user-circle-bold] cursor-pointer size-6  my-auto max-lg:ml-auto text-white">
                </span>
            @endif


                <!-- Dropdown Menu -->
                <div x-show="open" x-transition
                    class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-800 dark:divide-gray-600"
                    style="position: absolute; inset: 0px auto auto 0px; margin: 30px 0px 10px -130px; transform:translate3d(0px, 0px, 0px)"
                    @click.outside="open = false">

                    <!-- User Information -->
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-slate-400">
                        <div>{{ auth()->user()->name }}</div>
                        <div class="text-xs truncate">{{ auth()->user()->username }}</div>
                    </div>

                    <!-- Dropdown Links -->
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="{{ route('account.dashboard') }}" @click.prevent="Livewire.navigate('{{ route('account.dashboard') }}')"  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <button type="button" class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" @click.prevent="Livewire.dispatch('showModal', {status :true })">Ganti Password</button>
                        </li>
                        <!-- <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                        </li> -->
                    </ul>

                    <!-- Sign Out -->
                    <div class="py-1">


                    <form action="{{ route('logout') }}" class="w-full text-left">
                        @csrf
                        <button type="submit" class="text-left px-4 w-full py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Logout
                        </button>
                    </form>


                    </div>
                </div>
            </div>


            @else
            <span > | <a href="{{ route('login') }}" @click.prevent="Livewire.navigate('{{ route('login') }}')"> Login  </a></span>
            @endauth
        </div>
    </div>
</header>
