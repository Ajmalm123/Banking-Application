<x-app-layout>
@include('dashboard')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold">{{ __("Welcome,") }} {{ auth()->user()->name }}</h2>
                    <p>{{ __("Your ID: ") }} {{ auth()->user()->email }}</p>
                    <p>{{ __("Your Balance: ") }} {{ isset(auth()->user()->account->balance)?auth()->user()->account->balance:'0' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
