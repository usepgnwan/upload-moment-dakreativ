<div class=" mb-12 continer  sm:flex sm:flex-wrap sm:gap-6 sm:justify-evenly ">
    @for ($i = 0; $i < 12; $i++)
    <div class=" dark:shadow-gray-800 dark:bg-gray-800 dark:text-slate-400 rounded-xl shadow-lg mb-10 sm:mb-0 sm:w-64 md:w-80 lg:w-72  ">
        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300   dark:bg-gray-600 rounded-xl">
            <span class="icon-[mdi--file-image] w-10 h-10 text-gray-200 dark:text-gray-800"></span>
        </div>
        <div class="px-4 py-4 dark:text-slate-400">

            <div class=" mb-1  gap-1">
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-600 w-48 mb-4"></div>
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-600 mb-3"></div>
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-600 mb-3"></div>
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-600"></div>
            </div>
        </div>

        <hr class="dark:border-gray-700">

        <div class="px-4 text-sm  py-2 flex justify-between">
            <div class="w-9 h-w-9  icon-[solar--user-circle-bold] cursor-pointer size-6 text-gray-200" ></div>
            <div class="h-2.5  bg-gray-200 rounded-full dark:bg-gray-600 w-full mt-2"></div>
        </div>


        <!-- <div class="px-4 text-sm  py-2 w-full">
            <span class="block rounded-full px-10 py-6 bg-gray-200 ">  </span>
        </div> -->

    </div>
    @endfor


</div>
