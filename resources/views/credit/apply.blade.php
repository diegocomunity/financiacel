@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-xl mt-10">
    <h2 class="text-2xl font-bold mb-4">Credit Application</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('credits.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="client_id" class="block font-medium">Select Client</label>
            <select name="client_id" id="client_id" class="w-full border rounded p-2">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} (Score: {{ $client->credit_score }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="phone_id" class="block font-medium">Select Phone Model</label>
            <select name="phone_id" id="phone_id" class="w-full border rounded p-2">
                @foreach ($phones as $phone)
                    <option value="{{ $phone->id }}">
                        {{ $phone->model }} - ${{ number_format($phone->price, 0) }} ({{ $phone->stock }} available)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="term_months" class="block font-medium">Term (Months)</label>
            <input type="number" name="term_months" id="term_months" class="w-full border rounded p-2" min="1" max="36" value="12">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit Application
        </button>
    </form>
</div>
@endsection
