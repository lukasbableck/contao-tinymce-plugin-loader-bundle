<?php

namespace Lukasbableck\ContaoTinymcePluginLoaderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoTinymcePluginLoaderBundle extends Bundle {
	public function getPath(): string {
		return \dirname(__DIR__);
	}
}
