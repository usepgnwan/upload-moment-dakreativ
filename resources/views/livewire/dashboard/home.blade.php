<section>

    <h1 class="text-2xl font-semibold text-gray-900 mb-2">Dashboard</h1>
    <x-partials.dashboard.breadcumb :data="$breadcumb"> </x-partials.dashboard.breadcumb>

    <div class="  w-full rounded-lg text-center min-h-24 flex max-lg:flex-wrap  gap-1 md:gap-0  ">
        <div class=" w-1/2 md:w-full max-md:w-full p-1">
            <div class="bg-white rounded-lg p-2 dark:bg-gray-800  dark:border-gray-700 w-full border-slate-300">
                <h3 class="font-bold text-3xl"> Rp. {{$total_pendapatan}}</h3>
                <div class="flex items-center justify-center">
                <span class="icon-[ph--money-duotone]"></span> &nbsp; Pendapatan
                </div>
            </div>
        </div>
        <div class=" w-1/4 md:w-1/2  max-md:w-full p-1">
            <div class="bg-white rounded-lg p-2 dark:bg-gray-800  dark:border-gray-700 w-full border-slate-300">
                <h3 class="font-bold text-3xl"> {{$total_pelanggan}} </h3>
                <div class="flex items-center justify-center">
                    <span class="icon-[ph--user-list]"></span> &nbsp; Total Pelanggan
                </div>
            </div>
        </div>
        <div class=" w-1/4 md:w-1/2  max-md:w-full p-1">
            <div class="bg-white rounded-lg p-2 dark:bg-gray-800  dark:border-gray-700 w-full border-slate-300">
                <h3 class="font-bold text-3xl"> {{$paket}} </h3>
                <div class="flex items-center justify-center">
                    <span class="icon-[arcticons--packeta]"></span> &nbsp;  Jumlah Paket
                </div>
            </div>
        </div>
    </div>

</section>
