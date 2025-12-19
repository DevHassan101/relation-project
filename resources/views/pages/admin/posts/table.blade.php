   @php
       $i = 0;
   @endphp

   @forelse ($posts as $post)
       <tr>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
           </td>
           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $post->title }}</p>
           </td>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $post->user->name }}</p>
           </td>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
            @if ($post->is_published == 1)
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full capitalize">Published</span>
            @elseif ($post->is_published == 0)
                <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full capitalize">Draft</span>
            @endif
           </td>

           <td class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200">
               <div class="flex items-center justify-center gap-2 mb-4">

                   <div class="group relative inline-block">
                       <a href="{{ route('posts.edit', $post->id) }}" class="relative">
                           <i class="fa-solid fa-pen text-black"></i>
                           <span
                               class="absolute bottom-full left-1/2 mb-2 hidden w-auto -translate-x-1/2 whitespace-nowrap rounded bg-black px-2 py-1 text-xs text-white">
                               Edit
                           </span>
                       </a>
                   </div>

                   <div class="group relative inline-block">
                       <a href="{{ route('posts.show', $post->id) }}" class="relative">
                           <i class="fa-solid fa-eye text-indigo-600"></i>
                           <span
                               class="absolute bottom-full left-1/2 mb-2 hidden w-auto -translate-x-1/2 whitespace-nowrap rounded bg-black px-2 py-1 text-xs text-white">
                               Showz
                           </span>
                       </a>
                   </div>

                   <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                       @csrf @method('DELETE')
                       <div class="group relative inline-block">
                           <button type="submit" class="relative">
                               <i class="fa-solid fa-trash text-red-600"></i>
                               <span
                                   class="absolute bottom-full left-1/2 mb-2 hidden w-auto -translate-x-1/2 whitespace-nowrap rounded bg-gray-700 px-2 py-1 text-xs text-white">
                                   Delete
                               </span>
                           </button>
                       </div>
                   </form>
               </div>
           </td>
       </tr>
   @empty
       <tr>
           <td colspan="5" class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
               <p class="text-gray-900 whitespace-no-wrap">No users found.</p>
           </td>
       </tr>
   @endforelse
