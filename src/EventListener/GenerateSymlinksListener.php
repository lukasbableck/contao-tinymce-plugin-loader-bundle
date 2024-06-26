<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\GenerateSymlinksEvent;
use Contao\FilesModel;
use Contao\System;
use Lukasbableck\ContaoTinymcePluginLoaderBundle\Models\TinymcePluginModel;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::GENERATE_SYMLINKS)]
class GenerateSymlinksListener {
	public function __invoke(GenerateSymlinksEvent $event): void {
		$linkPath = 'assets/tinymce4/js/plugins/';
		$plugins = TinymcePluginModel::findAll();
		foreach ($plugins as $plugin) {
			$script = FilesModel::findByUuid($plugin->script)->path;
			if($script === null) {
				continue;
			}
			$projectDir = System::getContainer()->getParameter('kernel.project_dir');
			if(file_exists($projectDir.'/'.$linkPath.$plugin->name.'/'.$plugin->name.'.js')) {
				continue;
			}
			$event->addSymlink($script, $linkPath.$plugin->name.'/'.$plugin->name.'.js');
		}
	}
}
