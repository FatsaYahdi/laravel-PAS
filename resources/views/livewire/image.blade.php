<div>
    <div class="m-2 p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                {{-- modal --}}
                <x-button wire:click="showImageModal" class="mb-2">
                    Create
                </x-button>
                <x-dialog-modal wire:model="showingImageModal">
                    <x-slot name="title">
                        @if (!$isEditMode)
                            Creating
                        @else
                            Editing
                        @endif
                    </x-slot>
                    <x-slot name="content">
                        <form enctype="multipart/form-data">
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="title">Title</label>
                                <input wire:model.lazy="title" type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                @error('title')
                                    <span class="text-red-400 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="image">Image</label>
                                <input id="image" wire:model.lazy="image" class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" type="file" name="image" />
                                @error('image')
                                    <span class="text-red-400 mt-1">{{ $message }}</span>
                                @enderror
                                @if ($oldImage)
                                Old Image :
                                    <img src="{{ asset('storage/images/'.$oldImage) }}" alt="">
                                @endif
                                @if ($image)
                                Preview Image :
                                    <img src="{{ $image->temporaryUrl() }}" alt="">
                                @endif
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="description">Description</label>
                                <textarea id="description" wire:model.lazy="description" class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="description" maxlength="255" ></textarea>
                                @error('description')
                                    <span class="text-red-400 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </x-slot>
                    <x-slot name="footer">
                        @if ($isEditMode)
                        <x-button wire:click="updateImage">
                            Update
                        </x-button>
                        @else
                        <x-button wire:click="storeImage">
                            Create
                        </x-button>
                        @endif
                    </x-slot>
                </x-dialog-modal>
                {{-- end modal --}}
                <div class="shadow overflow-hidden border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 tracking-wider w-[5%]">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 tracking-wider">
                                    Image</th>
                                <th scope="col" class="py-3 relative px-6 text-center w-[10%]">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white dark:bg-gray-500  divide-gray-200">
                            @foreach ($imgs as $post)
                                <tr>
                                    <td class="px-6 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap">{{ $post->title }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <img class="w-10 h-8" src="{{ asset('/storage/images/'.$post->image_name) }}" />
                                    </td>
                                    <td class="px-6 py-2 text-end text-sm">
                                        <div class="flex justify-end space-x-2">
                                            <x-button class="bg-[blue] hover:bg-blue-600 transition-opacity duration-1000" wire:click="showEditImageModal({{ $post->id }})">Edit
                                            </x-button>
                                            <x-button class="bg-[red] hover:bg-red-600"
                                                wire:click="deleteImage({{ $post->id }})">Delete
                                            </x-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
