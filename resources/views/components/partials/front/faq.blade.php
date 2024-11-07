@props(['faq'=>[]])
<div class=" class=" continer mt-32 mb-12"">
    <h1 class="text-3xl font-bold text-center"> Apa Saja Yang Sering Di tanyakan ?</h1>
    <div class=" w-full lg:w-9/12 mx-auto flex max-lg:flex-wrap">
        <div class="lg:p-4 relative items-center rounded-xl text-center mx-auto mt-5">
            <img src="{{ asset('asset/img/home/question.png')}}" alt="" class="sm:h-56 h-36">
        </div>
        <div class="w-full mt-2 lg:w-9/12 sm:p-8 mx-2">
            <div id="accordion-open" data-accordion="open">
                @foreach($faq as $k => $item)
                    @php
                        $k += 1;
                    @endphp
                    @if ($loop->first)
                        <h2 id="accordion-open-heading-{{$k}}  " class="dropdown-toggle-button">
                            <button type="button" class=" flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-{{$k}}" aria-expanded="true" aria-controls="accordion-open-body-{{$k}}">
                                <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                    </svg> {{$item['title']}}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-open-body-1"  aria-labelledby="accordion-open-heading-{{$k}}">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="mb-2 text-gray-500 dark:text-gray-400">
                                        {!! $item['body'] !!}
                                    </div>
                            </div>
                        </div>

                    @else
                        <h2 id="accordion-open-heading-{{$k}}  " class="dropdown-toggle-button">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border @if(!$loop->last) border-b-0 @endif border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-{{$k}}" aria-expanded="false" aria-controls="accordion-open-body-{{$k}}">
                                <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                    </svg> {{$item['title']}}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-open-body-{{$k}}" class="hidden" aria-labelledby="accordion-open-heading-{{$k}}">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                <div class="mb-2 text-gray-500 dark:text-gray-400">
                                    {!! $item['body'] !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
</div>
