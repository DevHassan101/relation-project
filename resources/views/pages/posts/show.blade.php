<x-app-layout>


    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">Post Information</h1>
        <a href="{{ route('posts.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-8xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 capitalize">Added By: {{ $post->user->name }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <p class="font-semibold text-gray-700">Title</p>
                <p class="text-gray-600">{{ $post->title }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Published</p>
                <p class="text-gray-600">{{ $post->is_published ? 'Published' : 'Draft' }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Profile</p>
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" alt="post Image"
                        class="w-32 h-32 object-cover rounded-full">
                @else
                    <p class="text-gray-500">No Image Uploaded</p>
                @endif
            </div>


        </div>

        <div class="mt-8">

            <div class="grid grid-cols-1 gap-6">
                <div class="text-justify">
                    <p class="font-semibold mb-2 capitalize">description</p>
                    <p class="text-gray-600">{{ $post->content }}</p>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
