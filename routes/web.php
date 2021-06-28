<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageController;
// include controllers

Route::get('/status', 'UserController@userOnlineStatus');

// chat update


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/view_home_page', [App\Http\Controllers\HomeController::class, 'view_home_page'])->name('home');

// guild rooster
Route::get('/rooster', [App\Http\Controllers\RoosterController::class, 'rooster'])->name('rooster');

// events
Route::get('/events', [App\Http\Controllers\EventsController::class, 'events'])->name('events');

// my account
Route::get('/my_account', [App\Http\Controllers\MyAccountController::class, 'my_account'])->name('my_account');

// notifications
Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'notifications'])->name('notifications');

// mailbox
Route::get('/mailbox', [App\Http\Controllers\MailboxController::class, 'mailbox'])->name('mailbox');

// support
Route::get('/support', [App\Http\Controllers\SupportController::class, 'support'])->name('support');

// forum
Route::get('/forum', [App\Http\Controllers\ForumController::class, 'forum'])->name('forum');
Route::get('/view_category_page', [App\Http\Controllers\ForumController::class, 'view_forum_page'])->name('view_forum_page');

// moderator routes
Route::get('/moderator', [App\Http\Controllers\ModeratorController::class, 'moderator'])->name('moderator');
Route::get('/edit_post', [App\Http\Controllers\HomeController::class, 'edit_post'])->name('edit_post');
Route::get('/delete_post', [App\Http\Controllers\HomeController::class, 'delete_post'])->name('delete_post');
Route::get('/new_post', [App\Http\Controllers\HomeController::class, 'new_post'])->name('new_post');

// support page for admins and moderators
Route::get('/support_admin', [App\Http\Controllers\SupportAdminController::class, 'supp_admin'])->name('support_admin');

// admin routes
Route::get('/admin_panell_view_main', [App\Http\Controllers\AdministratorController::class, 'acp'])->name('admin_panell_view_main');

// admin accounts routes
Route::get('/save_profile', [App\Http\Controllers\AdministratorController::class, 'save_profile'])->name('save_profile');
Route::get('/unban', [App\Http\Controllers\AdministratorController::class, 'unban'])->name('unban');

// guild routes
Route::get('/guild_controll', [App\Http\Controllers\GuildController::class, 'gcp'])->name('guild_controll');
Route::get('/create_guild', [App\Http\Controllers\GuildController::class, 'g_create'])->name('create_guild');

// view profile
Route::get('/view_profile', [App\Http\Controllers\UsrProfileController::class, 'view_profile'])->name('view_profile');
Route::get('/rate_user', [App\Http\Controllers\UsrProfileController::class, 'rate_user'])->name('rate_user');
Route::get('/send_message', [App\Http\Controllers\UsrProfileController::class, 'send_message'])->name('send_message');

// admin website_settings routes
Route::get('/save_settings', [App\Http\Controllers\AdministratorController::class, 'save_settings'])->name('save_settings');


// chat


Route::resource('messages', MessageController::class)->only([
    'index',
    'store'
]);

