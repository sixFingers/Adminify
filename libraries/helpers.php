<?php namespace Adminify\Libraries;

use Laravel\Config as Config,
Laravel\Str as Str,
Laravel\Bundle as Bundle,
Laravel\URL as URL;

class Helpers{

	public static function getModels(){

		$models = scandir(path('app').'models');

		$exclude = Config::get('Adminify::settings.exclude');
		$exclude = array_merge($exclude, array('.', '..', '.gitignore'));

		$return = array();

		foreach($models as $model){
			$model = ucwords(str_replace('.php', '', $model));
			if(!in_array($model, $exclude)) $return[] = Str::plural($model);
		}

		return $return;

	}

	public static function getModel($model){

		$models = static::getModels();
		if(!in_array($model, $models)) return false;

		$model = Str::singular($model);

		return $model;

	}

	public static function getFields($model){

		$excluded = Config::get('Adminify::settings.fields');

		if(!isset($excluded[$model])) return $excluded['all'];

		return array_merge($excluded['all'], $excluded[$model]);

	}

	public static function handle(){
		return Bundle::$bundles['adminify']['handles'];
	}

	public static function url($url){
		$url = trim($url, '/');
		return URL::to(static::handle().'/'.$url);
	}

}