<x-app-layout>
    @include('dashboard')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h2 class="text-2xl font-semibold">{{ __('Deposit Money') }}</h2>
                    {{-- Deposit form --}}
                    <form method="POST" action="{{ route('deposit.store') }}" class="mt-6">
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full"
                                autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                        <x-primary-button>{{ __('Deposit') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
