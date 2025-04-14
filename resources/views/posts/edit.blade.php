<x-app-layout>
    <div class="my-[30px] max-w-[800px] mx-auto bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] sm:rounded-xl">
        <div class="py-[15px] text-center text-white border-b-2 border-white/20 font-medium text-[30px]">
            Edit Post
        </div>


        <div class="flex items-center ps-[20px] py-[15px]">
            <div>
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture"
                        class="rounded-full w-[40px] h-[40px] me-[10px] border border-gray-300 shadow-sm">
                @else
                    <p>No profile picture</p>
                @endif
            </div>
            <span class="font-medium text-[15px] text-white/50">
                {{ auth()->user()->name }}
            </span>
        </div>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
            x-data="fileUploadHandler({{ json_encode($post->media ?? []) }})"
            >
            @csrf
            @method('PUT')

            <div x-data="{ edited: false, checkChanges() { this.edited = true; } }"
                x-init="$watch('edited', value => console.log('Form edited:', value))">
           
                <div class="ps-[20px] flex flex-col border-b-2 border-white/20 gap-[10px] text-white">
                    <!-- Title Input -->
                    <div class="mt-[10px] me-[30px]">
                        <input type="text" id="title" name="title"
                            class="text-[50px] border-none mt-1 bg-inherit w-full rounded-md p-0 focus:ring-0"
                            value="{{ old('title', $post->title) }}" @input="checkChanges()">
                    </div>

                    <!-- Body Input -->
                    <div class="flex mb-[10px] place-items-start">
                        <input type="text" id="body" name="body"
                            class="mt-1 w-full border-none bg-inherit rounded-md ps-0 pb-[50px] focus:ring-0 "
                            value="{{ old('body', $post->body) }}" @input="checkChanges()">
                        <button class="mt-[5px] ms-[10px] me-[30px]">
                            <img src="{{ asset('storage/images/emoji.svg') }}" class="w-[20px] h-[20px] invert"
                                alt="add emoji">
                        </button>
                    </div>

                    <!-- Preview Container -->
                    <div id="preview-container"
                        class="bg-inherit me-[30px] py-[10px] flex flex-wrap gap-2 min-h-[50px] rounded-md"
                        x-show="previews.length > 0">

                        <!-- Display Preloaded Media -->
                        <template x-for="file in previews" :key="file">
                            <div>
                                <template x-if="file.type === 'image'">
                                    <img :src="file . url" alt="Uploaded Image" class="max-w-[150px]">
                                </template>
                                <template x-if="file.type === 'video'">
                                    <video controls class="max-w-[200px] rounded-md shadow-md">
                                        <source :src="file . url" type="video/mp4">
                                    </video>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- File Input -->
                    <input type="file" id="file-upload" name="media[]" class="hidden" multiple x-ref="fileInput"
                        @change="handleFileUpload($event)">

                    <div class="mb-[25px]">
                        <button type="button" class="px-[5px] py-[10px] active:translate-y-[2px]"
                            @click="$refs.fileInput.click()">
                            <img src="{{ asset('storage/images/clip.png') }}" class="w-[22px] invert" alt="add file">
                        </button>
                    </div>
                </div>

                <div class="flex justify-end pe-[10px] py-[20px] gap-[20px]">
                    <a href="{{ route('posts.index') }}"
                        class="border border-white px-[25px] py-[10px] text-white text-[15px] rounded-full active:translate-y-[2px]">Cancel</a>
                    <button type="submit"
                        class="bg-white px-[25px] py-[10px] text-[15px] rounded-full active:translate-y-[2px]"
                        :class="{ 'opacity-50 cursor-not-allowed': !edited }"
                        :disabled="!edited">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- <!-- External Alpine.js Script -->
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('fileUploadHandler', (preloadedFiles) => ({
                    previews: [],

                    init() {
                        // Load pre-existing media from post
                        if (preloadedFiles.length > 0) {
                            preloadedFiles.forEach(file => {
                                this.previews.push({
                                    type: file.match(/\.(png|jpg|jpeg|gif)$/) ? 'image' : 'video',
                                    url: "{{ asset('storage/') }}/" + file
                                });
                            });
                        }
                    },

                    handleFileUpload(event) {
                        const files = event.target.files;
                        this.previews = []; // Clear previous previews

                        if (files.length > 0) {
                            Array.from(files).forEach(file => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = () => {
                                        this.previews.push({ type: 'image', url: reader.result });
                                    };
                                    reader.readAsDataURL(file);
                                } else if (file.type.startsWith('video/')) {
                                    this.previews.push({ type: 'video', url: URL.createObjectURL(file) });
                                }
                            });
                        }
                    }
                }));
            });
        </script>
    @endpush --}}
</x-app-layout>