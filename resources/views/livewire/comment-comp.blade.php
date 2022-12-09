<div>
    <div class="flex mx-auto items-center justify-center shadow-lg mt-5 max-w-lg">
        {{-- <form class="w-full max-w-xl bg-white rounded-lg px-4 pt-2" wire:submit.prevent="addComment"> --}}
        <div class="flex flex-wrap -mx-3 mb-6">
            @if (session()->has('success'))
                <p class="px-4 pt-3 pb-2 w-full text-blue-600/100">
                    {{ session('success') }}
                </p>
            @endif
            @if (session()->has('error'))
                <div class="px-4 pt-3 pb-2 w-full text-red-600">
                    {{ session('error') }}
                </div>
            @endif
            <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h2>
            <div class="w-full md:w-full px-3 mb-2 mt-2">
                <textarea wire:model.lazy="content" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"></textarea>
            </div>
            <div class="w-full md:w-full flex items-start md:w-full px-3">
                <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                    <svg fill="none" class="w-5 h-5 text-gray-600 mr-1" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs md:text-sm pt-px">Some HTML is okay.</p>
                </div>
                <div class="-mr-1">
                    <button @if ( $updateMode ) wire:click="updateComment"  @else wire:click="addComment" @endif  class="bg-yellow-400 text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100""> @if ( $updateMode ) Update @else Add  @endif Comment</button>
                </div>
            </div>
        {{-- </form> --}}
        <br>
        <br>
        <br>
        
        @foreach ($comments as $comment)
            <div class="relative p-4 mb-8 border rounded-lg bg-white shadow-lg mt-100 w-full">
                <div class="relative flex mb-6">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-row justify-between">
                            <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{ $comment->user->name }}</p>
                            <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span class="mr-5" style="color: red; cursor: pointer;" wire:click="deleteComment({{ $comment->id }})">Delete</span>  
                        <span style="color: gree; cursor: pointer;" wire:click="showEditComment({{ $comment->id }})">Update</span>
                    </div>
                </div>
                <p class="-mt-4 text-gray-500">{{ $comment->content }}</p>
            </div>
        @endforeach

        {{ $comments->links() }}
        </div>
    </div>

</div>
