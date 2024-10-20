<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SddControllerController;


Route::get('getAllListDraft', [SddControllerController::class, 'getAllListDraft']);
Route::get('getAllListSTARBOOKS', [SddControllerController::class, 'getAllListSTARBOOKS']);
Route::get('getAllListDOSTv', [SddControllerController::class, 'getAllListDOSTv']);
Route::get('getAllListHR', [SddControllerController::class, 'getAllListHR']);
Route::get('getAllListLibrary', [SddControllerController::class, 'getAllListLibrary']);
Route::get('getAllListSJA', [SddControllerController::class, 'getAllListSJA']);
Route::get('getAllListPJS', [SddControllerController::class, 'getAllListPJS']);

Route::post('/getAllListDOSTv_guest_female/{expertalk_id}', [SddControllerController::class, 'getAllListDOSTv_guest_female']);
Route::post('/getAllListDOSTv_guest_male/{expertalk_id}', [SddControllerController::class, 'getAllListDOSTv_guest_male']);
Route::get('getAllListDOSTv_views', [SddControllerController::class, 'getAllListDOSTv_views']);


Route::get('getAllListHR_trainings', [SddControllerController::class, 'getAllListHR_trainings']);
Route::post('/getAllListHR_trainings_female/{id}', [SddControllerController::class, 'getAllListHR_trainings_female']);
Route::post('/getAllListHR_trainings_male/{id}', [SddControllerController::class, 'getAllListHR_trainings_male']);

Route::get('getTrainings_withTotalParticipants', [SddControllerController::class, 'getTrainings_withTotalParticipants']);
Route::get('getDOSTv_withTotalParticipants', [SddControllerController::class, 'getDOSTv_withTotalParticipants']);
Route::get('getOLLP_withTotalParticipants', [SddControllerController::class, 'getOLLP_withTotalParticipants']);
Route::get('getMatReq_withTotalParticipants', [SddControllerController::class, 'getMatReq_withTotalParticipants']);