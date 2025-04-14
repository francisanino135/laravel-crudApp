<x-app-layout>

    <x-auth-session-status class="mt-[15px]" :status="session('status')" />

    <x-input-error :messages="$errors->all()" class="mt-[15px]" id="error-message" />


    <div
        class="my-[30px] max-w-[800px] mx-auto bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] rounded-[16px] text-white">

        <div class="ps-[20px] pt-[20px]">
            <div class="flex mb-[20px]">
                @if ($post->user->profile_picture)
                    <img src="{{ url($post->user->profile_picture) }}" alt="Profile Picture"
                        class="rounded-full w-[40px] h-[40px] me-[10px] border border-gray-200 shadow-sm">
                @else
                    <p>No profile picture</p>
                @endif

                <span class="font-bold text-[15px] flex flex-col">
                    {{ $post->user->name }}
                    <span class="text-white/60 text-[12px]">
                        {{ $post->created_at->format('M d, Y') }}
                    </span>
                </span>
            </div>

            <div class="pb-[20px]">
                <!-- Post Title and Author -->
                <div>
                    <h3 class="text-[30px] font-bold mb-[35px]">
                        {{ $post->title }}
                    </h3>

                    <div class="text-[15px] ">
                        {!! $post->body !!}
                    </div>
                </div>

                <!-- Uploaded Images/Videos -->
                @if ($post->media && is_array($post->media))
                    <div class="mt-[20px] flex flex-wrap gap-[15px]">
                        @foreach ($post->media as $mediaItem)
                            @if (Str::endsWith($mediaItem, ['.png', '.jpg', '.jpeg', '.gif']))
                                <!-- Display image -->
                                <img src="{{ asset('storage/' . $mediaItem) }}" alt="Uploaded Image"
                                    class="max-w-[200px] border-4 border-gray-800">
                            @elseif(Str::endsWith($mediaItem, ['.mp4', '.mov', '.avi']))
                                <!-- Display video -->
                                <video controls class="max-w-[200px] rounded-md shadow-md">
                                    <source src="{{ asset('storage/' . $mediaItem) }}" type="video/mp4">
                                </video>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        @include('comments.index', ['comments' => $post->comments, 'post' => $post])
    </div>
</x-app-layout>
