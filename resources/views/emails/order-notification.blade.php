<x-mail-layout>
    <h1>Order Notification</h1>

    <div class="">
        <p>Hi {{ $transaction->status }},</p>
    </div>
    {{-- <p>{{ $message }}</p> --}}

    <p>Transaction ID: {{ $transaction->id }}</p> <!-- Akses properti valid -->
    <p>Customer Name: {{ $transaction->user->name }}</p> <!-- Akses relasi user -->

    <p>Thank you for shopping with us!</p>
</x-mail-layout>
