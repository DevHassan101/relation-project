<x-app-layout>


    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">Profile Information</h1>
        <a href="{{ route('profiles.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-8xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 capitalize">Added By: {{ $profile->creator->name }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <p class="font-semibold text-gray-700">Names</p>
                <p class="text-gray-600">{{ $profile->user->name }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Email</p>
                <p class="text-gray-600">{{ $profile->user->email }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Phone</p>
                <p class="text-gray-600">{{ $profile->phone }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Gender</p>
                <p class="text-gray-600">{{ $profile->gender }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Date of Birth</p>
                <p class="text-gray-600">
                    {{ \Carbon\Carbon::parse($profile->dob)->format('d-m-Y') }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-700">Profile</p>
                @if ($profile->profile)
                    <img src="{{ asset($profile->profile) }}" alt="Profile Image"
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
                    <p class="text-gray-600">{{ $profile->address }}</p>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
