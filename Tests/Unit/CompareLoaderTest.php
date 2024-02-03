<?php

namespace SUDHAUS7\Speedupyaml\Tests\Unit;

use SUDHAUS7\Speedupyaml\Tests\Unit\Mock\YamlFileLoaderMock;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use function file_get_contents;

class CompareLoaderTest extends UnitTestCase
{


	function testYamlFileIsLoadedAndParsed(): void
	{
		$content = file_get_contents( __DIR__.'/../Fixtures/test.yaml');
		$fileloader = new YamlFileLoaderMock();
		$parsedPecl = $fileloader->mockedUsePeclParser( $content);
		$parsedSymfony = $fileloader->mockedUseSymfonyParser( $content);


		$this->assertEquals( $parsedPecl['test']['a'], $parsedSymfony['test']['a']);
		$this->assertEquals( $parsedPecl['test']['b'], $parsedSymfony['test']['b']);
		$this->assertEquals( $parsedPecl['test']['c'], $parsedSymfony['test']['c']);



	}

}
