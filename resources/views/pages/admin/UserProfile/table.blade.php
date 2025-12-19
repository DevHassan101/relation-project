   @php
       $i = 0;
   @endphp

   @forelse ($userProfiles as $userProfile)
       <tr>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
           </td>
           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $userProfile->user->name }}</p>
           </td>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $userProfile->user->email }}</p>
           </td>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $userProfile->phone }}</p>
           </td>

           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
               <p class="text-gray-900 whitespace-no-wrap">{{ $userProfile->gender }}</p>
           </td>


           <td class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200">
               <div class="flex items-center justify-center gap-2 mb-4">

                   <div class="group relative inline-block">
                       <a href="{{ route('profiles.edit', $userProfile->id) }}" class="relative">
                           <i class="fa-solid fa-pen text-black"></i>
                           <span
                               class="absolute bottom-full left-1/2 mb-2 hidden w-auto -translate-x-1/2 whitespace-nowrap rounded bg-black px-2 py-1 text-xs text-white">
                               Edit
                           </span>
                       </a>
                   </div>


                   <div class="group relative inline-block">
                       <a href="{{ route('profiles.show', $userProfile->id) }}" class="relative">
                           <i class="fa-solid fa-eye text-indigo-600"></i>
                           <span
                               class="absolute bottom-full left-1/2 mb-2 hidden w-auto -translate-x-1/2 whitespace-nowrap rounded bg-black px-2 py-1 text-xs text-white">
                               View
                           </span>
                       </a>
                   </div>


                   <form action="{{ route('profiles.destroy', $userProfile->id) }}" method="POST">
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
              <td colspan="6" class="px-5 py-5 text-sm bg-white border-b border-gray-200 text-center">
                <p class="text-gray-900 whitespace-no-wrap">No profiles found.</p>
              </td>
         </tr>
   @endforelse