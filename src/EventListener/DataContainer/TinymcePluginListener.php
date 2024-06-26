<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle\EventListener\DataContainer;

use Contao\Automator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\System;

class TinymcePluginListener {
	#[AsCallback(table: 'tl_tinymce_plugin', target: 'config.onsubmit')]
	public function onSubmit(DataContainer $dc): void {
		(new Automator())->generateSymlinks();
	}

	#[AsCallback(table: 'tl_tinymce_plugin', target: 'config.ondelete')]
	public function onDelete(DataContainer $dc, int $undoId): void {
		$projectDir = System::getContainer()->getParameter('kernel.project_dir');
		if(!is_dir($projectDir . '/assets/tinymce4/js/plugins/'.$dc->name)) {
			return;
		}
		if(!is_link($projectDir . '/assets/tinymce4/js/plugins/'.$dc->name.'/plugin.min.js')) {
			return;
		}
		unlink($projectDir . '/assets/tinymce4/js/plugins/'.$dc->name.'/plugin.min.js');
	}
}
