<x-app-layout>
    <div class="text-base-content dark:text-gray-100">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="sm:p-8 bg-base-200 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-base-200 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
