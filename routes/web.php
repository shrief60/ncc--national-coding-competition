<?php

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

Route::any('locale/{locale}', 'LocaleController')->name('locale.switch');

Route::view('/', 'general.pages.home')->name('pages.home');

Route::view('/why-to-participate', 'general.pages.why-to-participate')->name('pages.why');

Route::view('/rules', 'general.pages.rules')->name('pages.rules');

Route::view('/rounds', 'general.pages.rounds')->name('pages.rounds');

Route::view('/prizes', 'general.pages.prizes')->name('pages.prizes');

Route::view('/judges', 'general.pages.judges')->name('pages.judges');

Route::view('/FAQs', 'general.pages.faq')->name('pages.faq');

Route::view('/submitting-tips', 'general.pages.submitting-tips')->name('pages.submitting-tips');

Route::view('/parents-tips', 'general.pages.parents-tips')->name('pages.parents-tips');
