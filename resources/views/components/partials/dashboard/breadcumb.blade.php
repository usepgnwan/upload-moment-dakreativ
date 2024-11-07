@props(['data' => [] ])
@if (count($data) > 0)
    <nav class="flex content-center  text-sm sm:text-sm mb-3">
        <ol class="inline-flex items-center space-x-1 md:space-x-1 rtl:space-x-reverse">

            @foreach ($data as $key => $value)
            @if ($loop->first)
                <li class="inline-flex items-center">
                    <a href="{{ route($value['route_name']) }}" @click.prevent="Livewire.navigate('{{ route($value['route_name']) }}')" class="inline-flex items-center font-medium text-gray-700 hover:text-[#FABE0E] dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5 dark:fill-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"></path>
                        </svg>
                        {{ $key }}
                    </a>
                </li>
            @else

            <li>
                <div class="flex items-center ">
                    <span class="icon-[ep--arrow-right] text-slate-800 "></span> &nbsp;
                    @if (isset($value['route_name']) && $value['route_name'] != null)
                        <a href="{{ route($value['route_name']) }}" @click.prevent="Livewire.navigate('{{ route($value['route_name']) }}')"
                         class="ms-1 font-medium text-gray-800 hover:text-[#FABE0E] md:ms-2 dark:text-gray-400 dark:hover:text-white">  {{ $key }}</a>
                    @else
                    <span class="ms-1 font-medium text-gray-500 md:ms-2 dark:text-gray-400"> {{ $key }}</span>
                    @endif
                </div>
            </li>
            @endif
            @endforeach
        </ol>
    </nav>
@endif
