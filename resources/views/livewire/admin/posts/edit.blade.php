<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Post
                        </h3>
                        <button wire:click="closeEditForm"
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form   wire:submit="save"
                            class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text"
                                    wire:model.blur="postForm.title"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul Postingan"
                                    >
                                <x-input-error :messages="$errors->get('postForm.title')" class="mt-2" />
                            </div>
                            <div class="col-span-2 sm:col-span-1">

                                <div    x-data="{ uploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = false"
                                        x-on:livewire-upload-cancel="uploading = false"
                                        x-on:livewire-upload-error="uploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <!-- File Input -->
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="large_size">Upload Gambar</label>
                                    <input  wire:model="postForm.new_image"
                                            class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="large_size" type="file">
                                    <x-input-error :messages="$errors->get('postForm.new_image')" class="mt-2" />

                                    <!-- Progress Bar -->
                                    <div x-show="uploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            @if($postForm->image)
                                                <div class="mt-2 p-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="large_size">
                                                        Old Photo
                                                    </label>
                                                    <img class="h-24 w-24 rounded" src="{{ asset('storage/'. $postForm->image) }}">
                                                </div>
                                            @endif
                                        </div>
                                    <div>
                                            @if ($postForm->new_image)
                                                <div class="mt-2 p-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="large_size">
                                                        New upload Photo
                                                    </label>
                                                    <img class="h-24 w-24 rounded" src="{{ $postForm->new_image->temporaryUrl() }}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                            </div>
                            {{-- <div class="col-span-2 md:col-span-2 flex">
                                @if ($postForm->image)
                                    <label for="current_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Baru</label>
                                    <img src="{{ asset('storage/' . $postForm->image) }}" class="w-24 h-24 mb-3 rounded-full shadow-lg" alt="New Image">
                                @endif
                                <label for="current_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Lama</label>
                                <img src="{{ asset('storage/'. $post->image->path) }}" class="w-24 h-24 mb-3 rounded-full shadow-lg" alt="Old Image">
                            </div> --}}
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category"
                                        wire:model="postForm.category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Select category</option>
                                    @foreach (\App\Helpers\ListCategory::ListCategories as $key => $item)
                                        <option value="{{ $key }}"> {{ $item }} </option>
                                    @endforeach
                                <x-input-error :messages="$errors->get('postForm.category')" class="mt-2" />
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="postForm.description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                <textarea   id="postForm.description"
                                            wire:model="postForm.description"
                                            rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                                <x-input-error :messages="$errors->get('postForm.description')" class="mt-2" />
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>