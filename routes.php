<?php

Route::get('/(:bundle)/models/(:any)', 'Adminify::models@index');

Route::controller(Controller::detect('adminify'));

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('admin/login');
});