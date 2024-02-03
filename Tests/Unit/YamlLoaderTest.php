<?php

namespace SUDHAUS7\Speedupyaml\Tests\Unit;

use Code711\Speedupyaml\YamlFileLoader;
use SUDHAUS7\Speedupyaml\Tests\Unit\Mock\YamlFileLoaderMock;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class PeclLoaderTest extends UnitTestCase
{


	function testYamlFileIsLoadedAndParsed(): void
	{
		$content = \file_get_contents( __DIR__.'/../Fixtures/test.yaml');
		$fileloader = new YamlFileLoaderMock();
		$parsed = $fileloader->mockedUseSymfonyParser( $content);

		$this->assertEquals( 1, $parsed['test']['a']);
		$this->assertEquals( 'test', $parsed['test']['b']);
		$this->assertIsArray( $parsed['test']['c']);
		$this->assertEquals( 'one', $parsed['test']['c'][0]);
	}

}
