<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PhoneController extends Controller
{
    //
    public function index(): JsonResponse
    {
        $phones = Phone::all(['id', 'model', 'price', 'stock']);
        return response()->json($phones);
    }
}
