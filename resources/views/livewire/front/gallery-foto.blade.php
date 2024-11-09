<div>
    <div style="display: flex; flex-direction: row; place-content: stretch center; box-sizing: border-box; width: 100%; gap: 12px;" class="px-3 py-6 max-w-lg w-full mx-auto">

        <div class="grid grid-cols-2 gap-2 w-full">
            <div class="grid grid-cols-1">
                <div class="w-full  space-y-4">
                    @foreach ($gallery1 as $v )
                    <div class="rounded-lg shadow-md relative">
                        <x-style.glithbox   data-title="{{$v->messages->name}}"     href="{{ $v->file }}" data-description="{{$v->messages->description}}" class="glightbox">
                            <x-style.glithbox.img  :url="$v->file"  class=" rounded-lg" />
                        </x-style.glithbox>
                        <div class="flex absolute bottom-4 max-lg:bottom-1 right-4 gap-1 z-40">
                           {{-- @if($v->type == 'private')
                                <span  href="{{ $v->file }}" download="{{ $v->file }}" target="_blank" class="cursor-pointer rounded-full px-4 bg-black text-white text-xs flex justify-center p-2">
                                Private
                                </span>
                            @endif--}}
                            <div data-tooltip-target="tooltip-default"
                                class="rounded-xl px-4 bg-black text-white text-xs  flex justify-center items-center">
                                <span class="icon-[tabler--message]"></span> &nbsp; {{$v->messages->name}}
                                <div id="tooltip-default" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    {{$v->messages->description}}
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>

                            <a  href="{{ $v->file }}" download="{{ $v->file }}" target="_blank" class="cursor-pointer rounded-full bg-black text-white text-xs flex justify-center p-2">
                                <span class="icon-[material-symbols--download]"></span>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="w-full  space-y-4">
                    @foreach ($gallery2 as $v )
                    <div class="rounded-lg shadow-md relative">
                        <x-style.glithbox    data-title="{{$v->messages->name}}"    href="{{ $v->file }}" data-description="{{$v->messages->description}}" class="glightbox">
                            <x-style.glithbox.img  :url="$v->file"   class=" rounded-lg" />
                        </x-style.glithbox>
                        <div class="flex absolute bottom-4 max-lg:bottom-1 right-4 gap-1 z-40">
                        {{--
                            @if($v->type == 'private')
                                <span  href="{{ $v->file }}" download="{{ $v->file }}" target="_blank" class="cursor-pointer rounded-full px-4 bg-black text-white text-xs flex justify-center p-2">
                                Private
                                </span>
                            @endif--}}
                            <div data-tooltip-target="tooltip-default"
                                class="rounded-xl px-4 bg-black text-white text-xs  flex justify-center items-center">
                                <span class="icon-[tabler--message]"></span> &nbsp; {{$v->messages->name}}
                                <div id="tooltip-default" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    {{$v->messages->description}}
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>

                            <a  href="{{ $v->file }}" download="{{ $v->file }}" target="_blank" class="cursor-pointer rounded-full bg-black text-white text-xs flex justify-center p-2">
                                <span class="icon-[material-symbols--download]"></span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">

        @if ( !in_array($hasMoreData, ['start','end']) && $countRows != 0)
        <div x-intersect.full="$wire.readMore()" class="text-center flex justify-center w-full">
            <span class="icon-[eos-icons--three-dots-loading] text-7xl text-blue-500"></span>
        </div>
        @endif

        @if ($hasMoreData == 'end' && $countRows == 1)
            <p class="text-center @if (!$hasMoreData)  hidden @endif">- Foto Gallery Selesai - </p>
        @endif

        @if($hasMoreData == 'start' && $countRows == 0)
        <p class="text-center @if (!$hasMoreData)  hidden @endif">- Foto belum tersedia - </p>
        @endif
    </div>

</div>
