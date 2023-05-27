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
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h2 class="text-2xl font-semibold">{{ __('Statement Of Account') }}</h2>
                    @if ($transactions->count() > 0)
                        {{-- Deposit form --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DATETIME</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">DETAILS</th>
                                    <th scope="col">BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>
                                            @if ($transaction->transaction_type === 1)
                                                Credit
                                            @elseif ($transaction->transaction_type === 2)
                                                Debit
                                            @elseif ($transaction->transaction_type === 3)
                                                Debit
                                            @elseif ($transaction->transaction_type === 4)
                                                Credit
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->transaction_type === 1)
                                                Deposit
                                            @elseif ($transaction->transaction_type === 2)
                                                Withdrawl
                                            @elseif ($transaction->transaction_type === 3)
                                                Transfer From {{ $transaction->recipient_email }}
                                            @elseif ($transaction->transaction_type === 4)
                                                Transfer to {{ $transaction->recipient_email }}
                                            @endif
                                        </td>
                                        <td>{{ $transaction->balance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    @else
                        <p>No transactions found.</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
