<section>
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Paket</h1>
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
                        <x-table.heading sortable multi-column wire:click="sortBy('title')" :direction="$sorts['title'] ?? null" class="w-40" >Nama Paket</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('harga')" :direction="$sorts['harga'] ?? null" >Harga</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('limit_file')" :direction="$sorts['limit_file'] ?? null" class="w-40"  >Limit File</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('limit_file')" :direction="$sorts['limit_file'] ?? null" class="w-40"  >Max Akses (Hari)</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('created_at')" :direction="$sorts['created_at'] ?? null" >Created At</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="9">
                                @unless ($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $data->count() }}</strong> Paket, do you want to select all <strong>{{ $data->total() }}</strong>?</span>
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

                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $values->title }} </span>
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                 {{ 'Rp. ' . number_format($values->harga, 0, ',', '.') }}
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                 {{ $values->limit_file }}
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                 {{ $values->limit_hari }}
                            </x-table.cell>
                            <x-table.cell class="pr-0">
                                 {{ $values->created_at }}
                            </x-table.cell>
                        </x-table.row>
                        @empty
                        <x-table.row>
                            <x-table.cell colspan="8">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No Paket found...</span>
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
            <x-slot name="title">Delete Paket</x-slot>
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
            <x-slot name="title">Create/Edit Paket</x-slot>

            <x-slot name="content">
                <x-input.group :inline="'true'" for="title" label="Nama Paket" :error="$errors->first('request.title')">
                    <x-input.text type="title" wire:model="request.title" id="title" placeholder="Nama Paket" />
                </x-input.group>

                <x-input.group :inline="'true'" for="harga" label="Harga" :error="$errors->first('request.harga')">
                    <x-input.text type="harga" wire:model="request.harga" id="harga" placeholder="Harga" type="number" />
                </x-input.group>

                <x-input.group :inline="'true'" for="limit_file" label="Limit File" :error="$errors->first('request.limit_file')">
                    <x-input.text type="limit_file" wire:model="request.limit_file" id="limit_file" placeholder="Limit File" type="number"  />
                </x-input.group>

                <x-input.group :inline="'true'" for="limit_hari" label="Max Akses (Hari)" :error="$errors->first('request.limit_hari')">
                    <x-input.text type="limit_hari" wire:model="request.limit_hari" id="limit_hari" placeholder="Max Akses (Hari)" type="number"  />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</section>
