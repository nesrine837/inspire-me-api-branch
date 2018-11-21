<?php


use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$excludedRoutes = ['except' =>
                    ['create', 'edit']];

Route::redirect('/', 'https://github.com/Red-Mountain-Dev/inspire-me-api', 301);

Route::resource('/v1/quotes', v1\QuotesController::class, $excludedRoutes);

Route::resource('/v1/quotees', v1\QuoteesController::class, $excludedRoutes);

Route::resource('/v1/nationalities', v1\NationalitiesController::class, $excludedRoutes);

Route::resource('/v1/professions', v1\ProfessionsController::class, $excludedRoutes);

Route::resource('/v1/categories', v1\CategoriesController::class, $excludedRoutes);

Route::post('v1/mailer', 'v1\MailerController@newProject');
Route::fallback(function () {
    $data = [];
    return response()->json($data, 404);
});
