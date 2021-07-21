<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $ymlist = [];
    if (auth()->user()) {
        $ymlist = auth()->user()->mapdata;
    }
    return view('layout', ['ymlist' => $ymlist]);
});

Route::post('/map', function (Request $request, Response $response) {
    $data = $request->all();
    if ($data) {
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->mapdata = $data;
        $user->save();
        return response()->json($user);
    } else {
        return response('No data', 404);
    }
});

Route::get('/ymgeo', function (Response $response) {
    $id = auth()->user()->id;
    $user = User::find($id);
    return response()->json($user->mapdata);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Dashboard');
