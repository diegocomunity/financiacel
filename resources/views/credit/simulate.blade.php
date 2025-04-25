<!-- resources/views/credit/simulate.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-xl mt-10">
    <h2 class="text-2xl font-bold mb-4">Payment Plan Simulation</h2>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Month</th>
                <th class="px-4 py-2 border">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instalments as $index => $amount)
                <tr>
                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border text-right">${{ number_format($amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 text-center">
        <a href="{{ route('credits.apply') }}" class="text-blue-600 hover:underline">Back to form</a>
    </div>
</div>
@endsection
