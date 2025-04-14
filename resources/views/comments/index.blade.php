<!-- resources/views/comments/index.blade.php -->

<!-- Display Comments -->
<div x-data="{ showCreateForm: true }" class="mt-[10px] px-[20px] pb-[15px] border-t-2 border-white/20">
    <h4 class="text-[20px] font-bold mt-[15px] mb-[20px]">Comments</h4>
    @forelse($comments as $comment)
        <div x-data="{ openEdit: false, editComment: '' }">
            <div class="flex flex-col">
                <!-- This section will now be conditionally hidden -->
                <div class="flex items-center justify-between mb-[15px]" x-show="!openEdit">
                    <!-- Comment Author -->
                    <div class="flex justify-between items-center me-[10px]">
                        @if ($comment->user)
                            @if ($comment->user->profile_picture)
                                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}"
                                    alt="User Profile Picture"
                                    class="rounded-full w-[45px] h-[40px] border border-gray-200 shadow-sm">
                            @endif
                        @else
                            <div
                                class="rounded-full w-[40px] h-[40px] me-[10px] border border-gray-200 flex items-center justify-center shadow-sm">
                                <span class="text-white text-xs"><img src="{{ asset('storage/images/avatar.png') }}"
                                        class="w-[20px] h-[20px]" alt="add emoji"></span>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col bg-gray-950 w-full rounded-full ps-[25px] py-[5px] gap-[5px]">
                        @if ($comment->user)
                            <span class="font-bold text-[14px]">{{ $comment->user->name }}</span>
                        @else
                            <span class="font-bold text-[14px] text-gray-500">[Deleted User]</span>
                        @endif
                        <div class="text-[14px]">
                            {{ $comment->comment }}
                        </div>
                    </div>
                    <div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button>
                                    <span
                                        class="material-symbols-rounded p-2 rounded-full hover:bg-gray-300 ">more_vert</span>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#"
                                    @click="openEdit = true; editComment = '{{ $comment->comment }}'; showCreateForm = false">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-4 py-2 text-start text-sm text-gray-400 hover:bg-gray-800 hover:rounded-md focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Edit Comment Form -->
                <div x-show="openEdit" class="mb-[15px] p-4 bg-inherit shadow-md border-4 border-gray-800">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex justify-end items-center me-[8px] mb-[15px]">
                            <button type="button" @click="openEdit = false; showCreateForm = true">
                                <img src="{{ asset('storage/images/cross.png') }}"
                                    class="w-[22px] h-[20px] rounded-full hover:bg-gray-400 active:bg-gray-400 active:translate-y-[2px]"
                                    alt="submit">
                            </button>
                        </div>

                        <div class="flex justify-between items-center">
                            <input type="text" name="comment" x-model="editComment"
                                class="bg-gray-300 border-none w-full rounded-full ps-[15px] py-[10px]" rows="3">
                            <button type="submit" @click="showCreateForm = true">
                                <img src="{{ asset('storage/images/submit.png') }}"
                                    class="w-[40px] h-[40px] rounded-full active:bg-gray-400 active:translate-y-[2px]"
                                    alt="submit">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="pb-[10px] text-[15px]">No comments yet. Be the first to comment!</p>
    @endforelse

    <!-- Add Comment Form -->
    <form action="{{ route('comments.create') }}" method="POST" enctype="multipart/form-data" x-show="showCreateForm">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="border-t border-gray-300 pt-[10px] ">
            <div class="flex justify-between items-center">

                <input type="text" name="comment"
                    class="text-[15px] text-white border-none w-full bg-inherit rounded-full me-[10px] focus:ring-1 focus:ring-white/30 focus:rounded-full placeholder:text-[15px]  placeholder:text-white/60"
                    placeholder="Add comment..." required>

                <button type="submit">
                    <img src="{{ asset('storage/images/submit.png') }}"
                        class="w-[40px] h-[40px] ms-auto rounded-full invert active:bg-gray-400 active:translate-y-[2px]"
                        alt="submit">
                </button>
            </div>
        </div>
    </form>
</div>

</div>
