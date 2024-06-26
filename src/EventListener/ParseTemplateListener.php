<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Lukasbableck\ContaoTinymcePluginLoaderBundle\Models\TinymcePluginModel;

#[AsHook('parseBackendTemplate', priority: 200)]
#[AsHook('parseFrontendTemplate', priority: 200)]
class ParseTemplateListener {
	public function __invoke(string $buffer, string $templateName): string {
		if (!str_contains($templateName, 'be_tinyMCE')) {
			return $buffer;
		}

		$plugins = TinymcePluginModel::findAll();
		if ($plugins === null) {
			return $buffer;
		}

		if (!isset($GLOBALS['TINYMCE']['SETTINGS']['PLUGINS'])) {
			$GLOBALS['TINYMCE']['SETTINGS']['PLUGINS'] = [];
		}

		foreach ($plugins as $plugin) {
			if (!\in_array($plugin->name, $GLOBALS['TINYMCE']['SETTINGS']['PLUGINS'])) {
				$GLOBALS['TINYMCE']['SETTINGS']['PLUGINS'][] = $plugin->name;
			}
		}

		return $buffer;
	}
}
