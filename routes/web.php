<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Newsletter;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::post('newsletter', NewsletterController::class);

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post}', [PostController::class, 'show'])->name('post.detail');
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
Route::get('admin/posts/{post:id}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
Route::patch('admin/posts/{post:id}', [AdminPostController::class, 'update'])->middleware('can:admin');
Route::delete('admin/posts/{post:id}', [AdminPostController::class, 'destroy'])->middleware('can:admin');
