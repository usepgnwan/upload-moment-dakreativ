<div class="w-full font-italiano text-white">

    <div class="fixed inset-0 bg-cover bg-center bg-no-repeat   max-w-lg max-lg:w-full mx-auto" style="background-image: url('{{ $foto['foto'] }}')">
        <div class="absolute inset-0 bg-black opacity-50 h-full"></div>
    </div>

    <section class="relative max-w-lg max-lg:w-full mx-auto bg-transparent">
        <div class="h-screen relative px-3 py-6  ">
            <div class="absolute inset-x-0 bottom-10 max-lg:bottom-60 z-10  text-center">
                <h1 class="text-6xl">{{ $user->name }}</h1>
                <p class="mt-5 text-3xl">{{ \Carbon\Carbon::parse($user->tanggal_acara)->format('d . m . Y') }}</p>
                <button type="button" class="bg-black text-white  border-none px-6 py-3 text-lg rounded-full mt-4 font-serif"  wire:click="$set('showUploadModal', true)">
                    Upload Moment
                </button>
            </div>
        </div>
        <div class="relative px-3 py-6  bg-white">
            <div class=" inset-x-0  top-28 z-10  text-center text-black">
                <!-- Button Uploaded -->
                <div data-dial-init class="absolute max-lg:fixed max-lg:z-50 bottom-6 end-6 group z-10">
                    <div id="speed-dial-menu-bottom-left" class="flex flex-col items-center hidden mb-4 space-y-2">
                        <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left"
                            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M14.419 10.581a3.564 3.564 0 0 0-2.574 1.1l-4.756-2.49a3.54 3.54 0 0 0 .072-.71 3.55 3.55 0 0 0-.043-.428L11.67 6.1a3.56 3.56 0 1 0-.831-2.265c.006.143.02.286.043.428L6.33 6.218a3.573 3.573 0 1 0-.175 4.743l4.756 2.491a3.58 3.58 0 1 0 3.508-2.871Z" />
                            </svg>
                            <span class="sr-only">Share</span>
                        </button>
                        <div id="tooltip-share" role="tooltip"
                            class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Share
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left" wire:click="$set('showUploadModal', true)"
                            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                            <span class="icon-[ep--upload-filled]  text-2xl"></span>
                            <span class="sr-only">Upload</span>
                        </button>
                        <div id="tooltip-download" role="tooltip"
                            class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Upload
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <button wire:click="download_zip()" type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left"
                            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                            <span class="icon-[line-md--download-loop] text-2xl"></span>
                            <span class="sr-only">Download All</span>
                        </button>
                        <div id="tooltip-copy" role="tooltip"
                            class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Download All
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    <button type="button" data-dial-toggle="speed-dial-menu-bottom-left"
                        aria-controls="speed-dial-menu-bottom-left" aria-expanded="false"
                        class="flex  items-center justify-center text-white bg-gray-700 rounded-full w-14 h-14 hover:bg-gray-600 dark:bg-blue-600 dark:hover:bg-gray-600 focus:ring-4 focus:bg-gray-600 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        <span class="sr-only">Open actions menu</span>
                    </button>
                </div>
                <!-- END UPLOADED -->
                <h1 class="text-6xl">Galery Foto</h1>
                <livewire:front.gallery-foto :lazy="true" :id="$user->id"></livewire:gallery-foto>
            </div>
        </div>




    </section>



    <form wire:submit.prevent="save">
        <x-modal.dialog :custom="__('text-black bg-white/90 rounded-lg mt-48')" wire:model.defer="modalMessages" backdrop='
            <div class="absolute x-inset-0 inset-y-14 flex flex-col items-center mx-auto   w-full font-italiano text-white text-center">
            <h1 class="text-5xl">{{ $user->name }}</h1>
            <p class="mt-2 text-3xl">{{ \Carbon\Carbon::parse($user->tanggal_acara)->format("d . m . Y") }}</p>
        </div>
        '>
            <div class="absolute inset-0 bg-black opacity-50 h-full">

            </div>

            <x-slot name="title">

                <div class="w-full flex justify-center mb-2">
                    <img src="{{ asset('assets/1.png') }}" alt="logo" class='lg:w-36 max-lg:w-20 mr-4' />
                </div>

                <p class=" text-center mb-2   text-gray-900 dark:text-white  font-serif text-xs">
                    Terima kasih sudah hadir <br>
                    Ucapkan Selamat untuk kedua mempelai
                </p>
            </x-slot>

            <x-slot name="content">
                <x-input.errors for="Password" :error="$errors->first('message.name')">
                    <x-input.text-line leadingAddOn='<span class="icon-[solar--user-line-duotone]"></span> ' :id="__('email')" wire:model="message.name" placeholder="Nama" type="input" />
                </x-input.errors>
                <x-input.errors for="Password" :error="$errors->first('message.description')">
                    <x-input.textarea-line wire:model="message.description" placeholder="Ucapan" type="input" />
                </x-input.errors>
            </x-slot>

            <x-slot name="footer">
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
    <form wire:submit.prevent="upload_moment">
        <x-modal.dialog :custom="__('text-black bg-white/90 rounded-lg mt-48 font-sans')" wire:model.defer="showUploadModal" backdrop='
            <div class="absolute x-inset-0 inset-y-14 flex flex-col items-center mx-auto   w-full font-italiano text-white text-center">
            <h1 class="text-5xl">{{ $user->name }}</h1>
            <p class="mt-2 text-3xl">{{ \Carbon\Carbon::parse($user->tanggal_acara)->format("d . m . Y") }}</p>
        </div>
        '>

            <x-slot name="title">
                <div class="w-full flex justify-center mb-2">
                    <img src="{{ asset('assets/1.png') }}" alt="logo" class='lg:w-36 max-lg:w-20 mr-4' />
                </div>
                <p class=" text-center mb-2   text-gray-900 dark:text-white   text-xs">
                    Upload Moment <br>
                </p>
            </x-slot>

            <x-slot name="content">
                <x-input.group for="Title" :inline="'true'" label="Foto" :error="$errors->first('request.file')">
                    <div x-data="{ uploading: false, progress: 0 ,
                                    resetFileInput() {
                                        document.getElementById('file').value = ''; // Reset file input
                                        $wire.set('request.file', 'remove'); // Clear Livewire model
                                    }
                            }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false; progress = 0;"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        @if ( $request['file'] )
                        <div class="relative">
                            <button type="button" class="absolute top-0  @if (is_null($request['file']) || $request['file'] == 'remove') hidden @endif left-2 rounded bg-red-500 p-3 mt-1 text-white" @click="resetFileInput()">X</button>
                            @if (method_exists($request['file'], 'temporaryUrl'))
                            @if (method_exists($request['file'], 'getMimeType') && str_starts_with($request['file']->getMimeType(), 'image/'))
                            <img class="object-cover mb-3  max-h-96" src="{{ $request['file']->temporaryUrl() }}" alt="Image preview">
                            @else
                            <p class="text-red-500">Invalid file type. Only image files are allowed.</p>
                            @endif
                            @else
                            <img class="object-cover mb-3 w-96 @if ($request['file'] =='remove') hidden  @endif" src="{{ $request['file'] }}" alt="Image preview">
                            @endif
                        </div>
                        @endif
                        <input type="file" name="file" id="file" wire:model="request.file" accept="image/*">
                        <p class="text-xs text-gray-400 mt-2">PNG, JPG SVG and GIF are Allowed.</p>
                        <div x-show="uploading">
                            <div class="w-full h-4 bg-slate-100 rounded-lg shadow-inner mt-3">
                                <div class="bg-green-500 h-4 rounded-lg" :style="{ width: `${progress}%` }"></div>
                            </div>
                        </div>
                    </div>
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showUploadModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>


</div>
