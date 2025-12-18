<x-app-layout>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all Profiles</h1>
        </div>
        <a href="{{ route('profiles.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-indigo-100 bg-indigo-600 text-white hover:bg-indigo-500 capitalize transition">
            add
        </a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
            <thead>

                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Name
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Email
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Phone
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Gender
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="userProfile-table">

            </tbody>
        </table>
    </div>
    <div id="pagination-links" class="mt-4"></div>

    <script>
        jQuery(document).ready(function() {
            fetchUserProfiles();

            jQuery(document).on('click', '#pagination-links a', function(event) {

                event.preventDefault();

                let url = jQuery(this).attr('href');

                let page = url.split('page=')[1];

                if (page) {
                    fetchUserProfiles(page);
                }
            });

            function fetchUserProfiles(page = 1) {
                jQuery.ajax({
                    type: 'GET',
                    url: '/profiles?page=' + page,
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            alert(response.message);
                        } else {
                            jQuery('#userProfile-table').html(response.html);
                            jQuery('#pagination-links').html(response.pagination);
                        }
                    },
                    error: function() {
                        console.log("Error: Data could not be fetched.");
                    }
                });
            }
        });
    </script>


    @if (session('success'))
        @push('script')
            <script>
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            </script>
        @endpush
    @endif
</x-app-layout>
