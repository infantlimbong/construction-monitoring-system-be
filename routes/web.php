<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes with different return contents
Route::get('/about', function () {
    return 'Ini halaman About.';
});

Route::get('/contact', function () {
    return 'Ini halaman Contact';
});

Route::get('/services', function () {
    return ['Web Design', 'SEO', 'Content Writing'];
});

Route::get('/portfolio', function () {
    return response()->json(['project1', 'project2', 'project3']);
});

Route::get('/testimonials', function () {
    return 'Ini halaman Testimonials';
});

// Routes with different route names and values displayed in the browser
Route::get('/user/{id}', function () {
    $id = 5;
    return 'User ID: ' . $id;
});

Route::get('/product/{category}/{id}', function () {
    $category = 'electronics';
    $id = 5;
    return 'Product Category: ' . $category . ', Product ID: ' . $id;
});

Route::get('/post/{year}/{month}/{day}', function () {
    $year = 2023;
    $month = '10';
    $day = 15;
    return 'Post Date: ' . $year . '-' . $month . '-' . $day;
});

Route::get('/search/{keyword?}', function ($keyword = null) {
    $keyword = 'programming';

    if ($keyword) {
        return 'Search Results for: ' . $keyword;
    } else {
        return 'Please provide a keyword to search.';
    }
});

Route::get('/category/{name}', function () {
    $name = 'Technology';
    return 'Category Name: ' . $name;
});

// Routes for new view files
Route::view('/users', 'users');
Route::view('/news', 'news');
Route::view('/comments', 'comments');