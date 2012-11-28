<?php

class Adminify_Base_Controller extends Controller {

	public $restful = true;
	public $layout = 'adminify::layouts.main';

	public function __construct(){

		parent::__construct();

		Config::set('auth.driver', 'adminauth');

		Asset::add('bootstrap', 'bundles/adminify/css/bootstrap.min.css');
		Asset::add('style', 'bundles/adminify/css/style.css');
		Asset::add('jquery', 'http://code.jquery.com/jquery-latest.min.js');
		Asset::add('bootstrapjs', 'bundles/adminify/js/bootstrap.min.js');

		$this->layout->name = Config::get('adminify::settings.name');
		$this->layout->models = Adminify\Libraries\Helpers::getModels();

		$this->filter('before', 'auth');

	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters){
		return Response::error('404');
	}

}