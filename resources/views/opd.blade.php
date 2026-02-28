<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('OPD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                        Nama
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-300">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">1</td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">Adi Murdayani</td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">adi@email.com</td>
                                    <td class="px-6 py-4">Aktif</td>
                                    <td class="px-6 py-4 text-center">Edit</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
