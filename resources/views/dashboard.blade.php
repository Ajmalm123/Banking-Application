    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="flex space-x-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('home')">
                <a href="{{route('dashboard')}}">Home</a>
            </x-nav-link>
            <x-nav-link :href="route('deposit')" :active="request()->routeIs('deposit')">
                <a href="{{ route('deposit') }}">Deposit</a>
            </x-nav-link>
            <x-nav-link :href="route('withdraw')" :active="request()->routeIs('withdraw')">
                <a href="{{ route('withdraw') }}">Withdraw</a>
            </x-nav-link>
            <x-nav-link :href="route('transfer')" :active="request()->routeIs('transfer')">
                <a href="{{ route('transfer') }}">Transfer</a>
            </x-nav-link>
            <x-nav-link :href="route('statement')" :active="request()->routeIs('statement')">
                <a href="{{ route('statement') }}">Statement</a>
            </x-nav-link>
            <x-nav-link >
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </x-nav-link>
        </div>
    </x-slot>    
