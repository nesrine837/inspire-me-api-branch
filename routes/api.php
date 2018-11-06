<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Mail\NewProject;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/v1/quotes', v1\QuotesController::class);
Route::resource('/v1/quotees', v1\QuoteesController::class);
Route::resource('/v1/nationalities', v1\NationalitiesController::class);
Route::resource('/v1/professions', v1\ProfessionsController::class);
Route::resource('/v1/categories', v1\CategoriesController::class);
Route::post('v1/mailer', function (Request $request) {
    $data = $request->input();
    fwrite()
    dd($request);
    \Mail::to('phabiannthepoet@gmail.com')->send(new NewProject($request->input()));
});
