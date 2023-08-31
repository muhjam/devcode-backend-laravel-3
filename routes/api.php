<?php

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hello', function () {
    return response()->json([
        'message' => 'Hello world'
    ]);
});

// TODO: Ganti handler dibawah untuk menggunakan model laravel untuk mendapatkan data ke db
Route::get('/contacts', function () {
    $contacts = contact::all();
    return response()->json([
        'status' => 'Success',
        'data' => $contacts,
    ]);
});

// TODO: Ganti handler dibawah untuk menggunakan model laravel untuk menyimpan data ke db
Route::post('/contacts', function (Request $request) {
    $newContact = $request->all();
    $contact = new contact();
    $contact->full_name = $newContact['full_name'];
    $contact->phone_number = $newContact['phone_number'];
    $contact->email = $newContact['email'];
    $contact->save();
    $response = response()->json([
        'message' => 'Contact created',
        'status' => 'Success',
        'data' => $contact,
    ]);
    return $response;
});