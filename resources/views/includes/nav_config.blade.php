@include('includes.modal',
['title'=>'Delete Account',
'paragraph_1'=>'Are you sure you want to delete your account?',
'paragraph_2'=>'You will lose all your images and all the account data.',
'route_name'=>'user.delete'
])

<div class="w-full self-start sm:max-w-xs mt-6 p-6 bg-white dark:bg-gray-900 shadow-md overflow-hidden sm:rounded-lg transition duration-700">
    <ul class="space-y-0 lg:space-y-4 sm:justify-evenly space-x-4 lg:space-x-0 sm:-my-px sm:flex lg:flex-col">
        <x-nav-link :href="route('config')" :active="request()->routeIs('config')">
            {{ __('General') }}
        </x-nav-link>
        <x-nav-link :href="route('change.form')" :active="request()->routeIs('change.form')">
            {{ __('Change Password') }}
        </x-nav-link>
        <x-nav-link onclick="openModal(true)" class="cursor-pointer" :active="request()->routeIs('user.delete')">
            {{ __('Delete User') }}
        </x-nav-link>
    </ul>
</div>
