<x-app-layout>

    <div class="flex justify-between items-center my-3">
        <div class="text-2xl font-bold text-gray-800 capitalize">
            <h1>edit post</h1>
        </div>
        <a href="{{ route('posts.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-indigo-100 bg-indigo-600 text-white hover:bg-indigo-500 capitalize transition">
            back
        </a>
    </div>

    <div class=" bg-white border border-gray-300 rounded-2xl">
        <form class="bg-white rounded px-3 pt-6 pb-4 mb-4" action="{{ route('posts.update', $post->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title <span class="text-red-700">*</span>
                    </label>
                    <input class="border rounded w-full py-2 px-3 text-gray-700" id="title" name="title"
                        value="{{ old('title', $post->title) }}" type="text" placeholder="Enter title">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    <input class="border rounded w-full py-2 px-3 text-gray-700" id="image" name="image"
                        type="file">
                        <img src="{{ asset($post->image) }}" alt="Post Image" class="w-20 h-20 mt-2 object-cover rounded-full">
                    @error('image')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                    {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:outline-none">
                <label for="is_published" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer">
                    Publish this post
                </label>
            </div>

            <div class="">
                <label for="content" class="block mb-1 font-medium capitalize text-black">content <span
                        class="text-red-700">*</span></label>
                <textarea id="content" name="content" rows="6" placeholder="Write content here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('content', $post->content) }}</textarea>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button
                class="bg-blue-500 hover:bg-blue-700 text-white mt-1 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
