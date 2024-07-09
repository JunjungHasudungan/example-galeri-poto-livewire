
<div class="py-2">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-2 text-gray-900">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-600">
                    <!-- Modal header -->
                    <!-- Modal body -->
                    <form   wire:submit="store"
                            class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text"
                                    wire:model.blur="title"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul Postingan"
                                    >
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <!-- File Input -->
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="large_size">Large file input</label>
                                <input  wire:model="image"
                                        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="large_size" type="file">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @if ($image)
                                    <div class="mt-2">
                                        <img class="w-24 h-24 rounded-lg" src="{{ $image->temporaryUrl() }}">
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category"
                                        wire:model="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Select category</option>
                                    @foreach (\App\Helpers\ListCategory::ListCategories as $key => $item)
                                        <option value="{{ $key }}"> {{ $item }} </option>
                                    @endforeach
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                <textarea   id="description"
                                            wire:model="description"
                                            rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            <x-action-message class="me-3" on="post-saved">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
