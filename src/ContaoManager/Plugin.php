<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Lukasbableck\ContaoTinymcePluginLoaderBundle\ContaoTinymcePluginLoaderBundle;

class Plugin implements BundlePluginInterface {
	public function getBundles(ParserInterface $parser): array {
		return [BundleConfig::create(ContaoTinymcePluginLoaderBundle::class)->setLoadAfter([ContaoCoreBundle::class, ])];
	}
}
