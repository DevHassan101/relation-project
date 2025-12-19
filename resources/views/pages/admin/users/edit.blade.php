<x-app-layout>

    <div class="flex justify-between items-center my-3">
        <div class="text-2xl font-bold text-gray-800 capitalize">
            <h1>edit user</h1>
        </div>
        <a href="{{ route('users.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-indigo-100 bg-indigo-600 text-white hover:bg-indigo-500 capitalize transition">
            back
        </a>
    </div>

    <div class=" bg-white border border-gray-300 rounded-2xl">
        <form class="bg-white rounded px-3 pt-6 pb-4 mb-4" action="{{ route('users.update', $user->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4 mb-4">

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name <span class="text-red-700">*</span>
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700"
                        id="name" name="name" value="{{ old('name', $user->name) }}" type="text"
                        placeholder="Enter Account Name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email <span class="text-red-700">*</span>
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700"
                        id="email" name="email" value="{{ old('email', $user->email) }}" type="text"
                        placeholder="Enter Account Name">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700"
                        id="phone" name="phone" value="{{ old('phone', $user->profile->phone) }}" type="text"
                        placeholder="Enter Account Name">
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Gender
                    </label>
                    <select name="gender" class="border border-gray-900 w-full capitalize rounded py-1.5">
                        <option value="">Select One</option>
                        <option value="male" @selected(old('gender', $user->profile->gender) == 'male')>male</option>
                        <option value="female" @selected(old('gender', $user->profile->gender) == 'female')>female</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="profile">
                        Profile
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700"
                        id="profile" name="profile" type="file">
                    <img src="{{ asset($user->profile->profile) }}" alt="Profile Image"
                        class="w-32 h-32 object-cover rounded-full">
                    @error('profile')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">
                        Date of Birth
                    </label>

                    <input type="date" id="date" name="dob" class="border rounded w-full py-2 px-3 text-gray-700" value="{{ old('dob', $user->profile->dob) }}"
                        min="{{ date('Y-m-d') }}" class="rounded w-full py-1.5 px-2 text-black">
                </div>

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-gray-700"
                        id="password" name="password" value="{{ old('password') }}" type="password"
                        placeholder="Enter Account Name">
                </div>
            </div>

            <div class="">
                <label for="address" class="block mb-1 font-medium capitalize text-black">address</label>
                <textarea id="address" name="address" rows="6" placeholder="Write address here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('address', $user->profile->address) }}</textarea>
            </div>

            <button
                class="bg-blue-500 hover:bg-blue-700 text-white mt-1 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
