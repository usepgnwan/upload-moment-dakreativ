<section>
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Event</h1>
        <x-partials.dashboard.breadcumb :data="$breadcumb"> </x-partials.dashboard.breadcumb>
        <div class="py-4 space-y-4">
            <!-- Top Bar -->
            <div class="flex justify-between max-lg:flex-wrap">
                <div class="w-2/4 flex space-x-4  max-lg:w-full">
                    <div class="w-10/12">
                        <x-input.text wire:model.live.debounce.300ms="filters.search" placeholder="cari..." />
                    </div>
                </div>

                <div class="space-x-2 flex items-center max-lg:w-full" wire:ignore>
                    <x-input.select wire:model.live.debounce.300ms="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </x-input.select>

                    <x-dropdown label="Bulk Actions" class="hidden">


                        <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                            <x-icon.trash class="text-cool-gray-400" /> <span>Delete</span>
                        </x-dropdown.item>
                    </x-dropdown>
                    <x-button.primary wire:click="create"><x-icon.plus /> New</x-button.primary>
                </div>
            </div>

            <!-- users Table -->
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="pr-0 w-8">
                            <x-input.checkbox wire:model.live="selectPage" />
                        </x-table.heading>
                        <x-table.heading class="pr-0 w-8">No.</x-table.heading>
                        <x-table.heading>.::.</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Nama Pelanggan</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Qr Code</x-table.heading>
                        <x-table.heading>Event</x-table.heading>
                        <x-table.heading>
                            <div class=" w-20"> Nama Paket</div>
                        </x-table.heading>
                        <x-table.heading>
                            <div class=" w-28">Harga Paket</div>
                        </x-table.heading>
                        <x-table.heading>Limit File</x-table.heading>
                        <x-table.heading>Maxs Akses (Hari)</x-table.heading>
                        <x-table.heading>Foto </x-table.heading>
                        <x-table.heading>Foto Sampul</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="9">
                                @unless ($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $data->count() }}</strong> Pelanggan, do you want to select all <strong>{{ $data->total() }}</strong>?</span>
                                    <x-button.link wire:click="selectAllPage" class="ml-1 text-blue-600">Select All</x-button.link>
                                </div>
                                @else
                                <span>You are currently selecting all <strong>{{ $data->total() }}</strong> users.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                        @endif

                        @forelse ($data as $k => $values)

                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $values->id }}" wire:target="filters.search,perPage,gotoPage, previousPage, nextPage">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model.live="selected" value="{{ $values->id }}" />
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                {{$k+$data->firstItem()}}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex">
                                    <x-button.link wire:click="edit({{ $values->id }})" class="bg-green-500 mx-1 px-2 py-1 rounded text-white" title="Edit"><span class="icon-[uil--edit]"></span></x-button.link>
                                    <x-button.link download="QR-{{ $values->username }}.png"  target="_blank" href="{{ route('download.qr', ['url'=>$values->username]) }}" class="bg-blue-500 mx-1 px-2 py-1 rounded text-white" title="Download QR CODE"><span class="icon-[mdi--qrcode-scan]"></span></x-button.link>
                                    <x-button.link target="_blank" href="{{ route('toPage', ['slug'=>$values->username]) }}" class="bg-blue-500 mx-1 px-2 py-1 rounded text-white" title="Lihat Galeri Foto"><span class="icon-[simple-icons--firefoxbrowser]"></span></x-button.link>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $values->name }} </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">   <img src="{{ route('download.qr', ['url'=>$values->username]) }}" alt=""> </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $values->event->title }} </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $values->paket->title }} </span>
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                {{ 'Rp. ' . number_format($values->paket->harga, 0, ',', '.') }}
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                {{ $values->paket->limit_file }}
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                {{ $values->paket->limit_hari }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="w-16">
                                    <x-style.glithbox href="{{ $values->foto }}" class="glightbox">
                                        <x-style.glithbox.img :url="$values->foto" alt="image not found" class=" object-contain  hover:grayscale transition-all duration-700 ease-in-out mx-auto lg:col-span-4 md:col-span-6 w-full h-full" />
                                    </x-style.glithbox>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="w-16">
                                    <x-style.glithbox href="{{ $values->foto_sampul }}" class="glightbox">
                                        <x-style.glithbox.img :url="$values->foto_sampul" alt="image not found" class=" object-contain  hover:grayscale transition-all duration-700 ease-in-out mx-auto lg:col-span-4 md:col-span-6 w-full h-full" />
                                    </x-style.glithbox>
                                </div>

                            </x-table.cell>


                        </x-table.row>
                        @empty
                        <x-table.row>
                            <x-table.cell colspan="8">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No Pelanggan can't be found...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>

                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Transactions Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Pelanggan</x-slot>
            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>
    <!-- Save Transaction Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Create/Edit Pelanggan</x-slot>

            <x-slot name="content">
                <x-input.group :inline="'true'" for="name" label="Nama Pelanggan" :error="$errors->first('request.name')">
                    <x-input.text type="name" wire:model="request.name" id="name" placeholder="Nama Pelanggan" />
                </x-input.group>
                <div class="w-full max-md:w-full pl-2 space-y-4">
                    <x-input.group for="Title" :inline="'true'" label="Foto" :error="$errors->first('request.foto')">
                        <div
                            x-data="{ uploading: false, progress: 0 ,
                                    resetFileInput() {
                                        document.getElementById('file').value = ''; // Reset file input
                                        $wire.set('request.foto', 'remove'); // Clear Livewire model
                                    }
                            }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false; progress = 0;"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            @if ( $request['foto'] )
                            <div class="relative">
                                <button type="button" class="absolute top-0  @if (is_null($request['foto']) || $request['foto'] == 'remove') hidden @endif left-2 rounded bg-red-500 p-3 mt-1 text-white" @click="resetFileInput()">X</button>
                                @if (method_exists($request['foto'], 'temporaryUrl'))
                                @if (method_exists($request['foto'], 'getMimeType') && str_starts_with($request['foto']->getMimeType(), 'image/'))
                                <img class="object-cover mb-3 w-96" src="{{ $request['foto']->temporaryUrl() }}" alt="Image preview">
                                @else
                                <p class="text-red-500">Invalid file type. Only image files are allowed.</p>
                                @endif
                                @else
                                <img class="object-cover mb-3 w-96 @if ($request['foto'] =='remove') hidden  @endif" src="{{ $request['foto'] }}" alt="Image preview">
                                @endif
                            </div>
                            @endif
                            <input type="file" name="file" id="file" wire:model="request.foto" accept="image/*">
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG SVG and GIF are Allowed.</p>
                            <div x-show="uploading">
                                <div class="w-full h-4 bg-slate-100 rounded-lg shadow-inner mt-3">
                                    <div class="bg-green-500 h-4 rounded-lg" :style="{ width: `${progress}%` }"></div>
                                </div>
                            </div>
                        </div>
                    </x-input.group>
                </div>
                <div class="w-full max-md:w-full pl-2 space-y-4">
                    <x-input.group for="Title" :inline="'true'" label="Foto Sampul" :error="$errors->first('request.foto_sampul')">
                        <div
                            x-data="{ uploading: false, progress: 0 ,
                                    resetFileInput() {
                                        document.getElementById('file').value = ''; // Reset file input
                                        $wire.set('request.foto_sampul', 'remove'); // Clear Livewire model
                                    }
                            }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false; progress = 0;"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            @if ( $request['foto_sampul'] )
                            <div class="relative">
                                <button type="button" class="absolute top-0  @if (is_null($request['foto_sampul']) || $request['foto_sampul'] == 'remove') hidden @endif left-2 rounded bg-red-500 p-3 mt-1 text-white" @click="resetFileInput()">X</button>
                                @if (method_exists($request['foto_sampul'], 'temporaryUrl'))
                                @if (method_exists($request['foto_sampul'], 'getMimeType') && str_starts_with($request['foto_sampul']->getMimeType(), 'image/'))
                                <img class="object-cover mb-3 w-96" src="{{ $request['foto_sampul']->temporaryUrl() }}" alt="Image preview">
                                @else
                                <p class="text-red-500">Invalid file type. Only image files are allowed.</p>
                                @endif
                                @else
                                <img class="object-cover mb-3 w-96 @if ($request['foto_sampul'] =='remove') hidden  @endif" src="{{ $request['foto_sampul'] }}" alt="Image preview">
                                @endif
                            </div>
                            @endif
                            <input type="file" name="file" id="file" wire:model="request.foto_sampul" accept="image/*">
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG SVG and GIF are Allowed.</p>
                            <div x-show="uploading">
                                <div class="w-full h-4 bg-slate-100 rounded-lg shadow-inner mt-3">
                                    <div class="bg-green-500 h-4 rounded-lg" :style="{ width: `${progress}%` }"></div>
                                </div>
                            </div>
                        </div>
                    </x-input.group>
                </div>
                <div class="w-full space-y-4">
                    <x-input.group for="Kelas" :inline="'true'" label="Event" :error="$errors->first('request.event_id')">
                        <div wire:ignore>
                            <x-input.select wire:model.live.debounce.300ms="request.event_id" :placeholder="__('- Pilih Event -')">
                                <option value="">Pilih Event</option>
                                @foreach ($event as $value => $label)
                                <option value="{{ $label->id }}" @if($request['event_id']==$label->id) selected @endif>{{ $label->title }} </option>
                                @endforeach
                            </x-input.select>
                        </div>

                    </x-input.group>
                </div>
                <div class="w-full space-y-4">
                    <x-input.group for="Paket" :inline="'true'" label="Paket" :error="$errors->first('request.paket_id')">
                        <div wire:ignore>
                            <x-input.select wire:model.live.debounce.300ms="request.paket_id" :placeholder="__('- Pilih Paket -')">
                                <option value="">Pilih Event</option>
                                @foreach ($paket as $value => $label)
                                <option value="{{ $label->id }}" @if($request['paket_id']==$label->id) selected @endif>{{ $label->title }} </option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-input.group>
                </div>
                <div class="flex flex-wrap px-1">
                    @if (!empty($detailPaket))
                    <div class="w-full">
                        <h3 class="text-xl font-semibold">Detail Paket</h3>
                    </div>
                    <div class="w-1/2">
                        <p>
                            <span class=" "> Harga : </span>   {{ 'Rp. ' . number_format($detailPaket['harga'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-1/2">
                        <p>
                            <span class=" "> Limit File : </span> {{$detailPaket['limit_file']}}
                        </p>
                    </div>
                    <div class="w-1/2">
                        <p>
                            <span class=" "> Max Akses (Hari) : </span> {{$detailPaket['limit_hari']}}
                        </p>
                    </div>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</section>
