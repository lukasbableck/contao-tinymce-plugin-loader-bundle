<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\GenerateSymlinksEvent;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\FilesModel;
use Contao\System;
use Doctrine\DBAL\Connection;
use Lukasbableck\ContaoTinymcePluginLoaderBundle\Models\TinymcePluginModel;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::GENERATE_SYMLINKS)]
class GenerateSymlinksListener {
	public function __construct(private ContaoFramework $contaoFramework, private Connection $connection) {
	}

	public function __invoke(GenerateSymlinksEvent $event): void {
		$this->contaoFramework->initialize();
		$table = TinymcePluginModel::getTable();
		if (!$this->connection->createSchemaManager()->tablesExist([$table])) {
			return;
		}
		$linkPath = 'assets/tinymce4/js/plugins/';
		$plugins = TinymcePluginModel::findAll();
		foreach ($plugins as $plugin) {
			$script = FilesModel::findByUuid($plugin->script)->path;
			if ($script === null) {
				continue;
			}
			$projectDir = System::getContainer()->getParameter('kernel.project_dir');
			if (file_exists($projectDir.'/'.$linkPath.$plugin->name.'/'.$plugin->name.'.js')) {
				continue;
			}
			$event->addSymlink($script, $linkPath.$plugin->name.'/plugin.min.js');
		}
	}
}
