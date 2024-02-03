<?php

namespace SUDHAUS7\Speedupyaml\Tests\Unit\Mock;

use Code711\Speedupyaml\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlFileLoaderMock extends YamlFileLoader
{

	public function mockedUseSymfonyParser(string $content):array
	{
		return parent::useSymfonyParser( $content);
	}
	public function mockedUsePeclParser(string $content):array
	{
		return parent::usePeclParser( $content);
	}
}
