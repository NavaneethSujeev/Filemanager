<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\filemanager;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::any('/',[filemanager::class, 'filemanager'])->name('filemanager');
Route::any('/addfolder',[filemanager::class, 'addfolder'])->name('addfolder');
Route::any('/delete',[filemanager::class, 'delete'])->name('delete');
Route::any('/addfile',[filemanager::class, 'addfile'])->name('addfile');
Route::any('/fileopen',[filemanager::class, 'fileopen'])->name('fileopen');
Route::any('/update',[filemanager::class, 'update'])->name('update');
Route::any('/edit',[filemanager::class, 'edit'])->name('edit');
Route::any('/check',[filemanager::class, 'check'])->name('check');






