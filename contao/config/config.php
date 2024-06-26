<?php

use Lukasbableck\ContaoTinymcePluginLoaderBundle\Models\TinymcePluginModel;

$GLOBALS['BE_MOD']['system'] = [
	'tinymce_plugins' => [
		'tables' => ['tl_tinymce_plugin'],
	],
];

$GLOBALS['TL_MODELS']['tl_tinymce_plugin'] = TinymcePluginModel::class;