<x-app-layout>

    <div class="my-[30px] max-w-[800px] mx-auto bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] sm:rounded-xl">
        <div class="py-[15px] text-center text-white border-b-2 border-white/20 font-medium text-[30px]">
            Create Post
        </div>

        <div class="flex items-center ps-[20px] py-[15px] gap-2">
            <div>
                @if(Auth::user()->profile_picture)
                <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture"
                        class="rounded-full border-[2px] border-gray-300 shadow-md w-[35px] h-[35px]">
                @else
                    <p>No profile picture</p>
                @endif
            </div>
            <span class="font-medium text-[15px] text-white/50">
                {{ Auth::user()->name }}
            </span>
        </div>

        <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data"
            x-data="fileUploadHandlerCreate()">
            @csrf

            <div class="flex flex-col border-b-2 border-white/20 gap-[10px] text-white">
                <div class="mt-[10px] mx-[30px]">
                    <input type="text" id="title" name="title"
                        class="text-[50px] bg-inherit border-none mt-1 w-full rounded-md p-0 focus:ring-0 placeholder:text-white/60"
                        placeholder="Untitled">
                </div>

                <div class="flex mb-[10px] mx-[30px] relative">
                    <input type="text" id="body" name="body"
                        class="mt-1 w-full bg-inherit border-none rounded-md ps-0 pb-[50px] focus:ring-0 placeholder:text-white/60"
                        placeholder="Add short description...">
                    <button class=" absolute right-2 top-2"><img src="{{ asset('storage/images/emoji.svg') }}"
                            class="w-[20px] h-[20px] invert" alt="add emoji"></button>
                </div>

                <div id="preview-container"
                    class="bg-gray-800 me-[30px] ps-[10px] py-[10px] flex flex-wrap gap-2 mt-4 min-h-[50px] border border-gray-800 rounded-md"
                    x-show="previews.length > 0">
                    <template x-for="file in previews" :key="file.id">
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

                <input type="file" id="file-upload" name="media[]" class="hidden" multiple x-ref="fileInput"
                    @change="handleFileUpload($event)">
                <div class="mb-[25px] ms-[30px]">
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
                    class="bg-white px-[25px] py-[10px] text-[15px] rounded-full active:translate-y-[2px]">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    </div>

    {{-- @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('fileUploadHandler', () => ({
                    previews: [],

                    handleFileUpload(event) {
                        const files = event.target.files;
                        this.previews = [];

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