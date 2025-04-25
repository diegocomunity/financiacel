@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-xl mt-10 text-center">
    <h2 class="text-2xl font-bold mb-4 text-green-600">Application Submitted Successfully!</h2>
    <p class="text-gray-700 mb-4">Your application ID is <strong>{{ $application_id }}</strong>.</p>

    <a href="{{ route('credits.show', $application_id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        View Application
    </a>
</div>
@endsection
