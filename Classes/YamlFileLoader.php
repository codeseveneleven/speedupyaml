<?php

namespace Code711\Speedupyaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use  TYPO3\CMS\Core\Configuration\Loader as Core;
use TYPO3\CMS\Core\Configuration\Loader\Exception\YamlParseException;
use function function_exists;

class YamlFileLoader extends Core\YamlFileLoader
{


	protected function useSymfonyParser(string $content):array
	{
		return Yaml::parse( $content);
	}
	protected function usePeclParser(string $content):array
	{

		// taken and adapted from helhum/config-loader

		set_error_handler(function ($_, $errorMessage) {
			throw new ParseException( $errorMessage);
		});
		try {
			$config = yaml_parse($content);
		} catch (ParseException $e) {
			throw new ParseException(sprintf('Error while parsing file "%s", Message: "%s"', $fileName, $e->getMessage()));
		} finally {
			restore_error_handler();
		}
		return $config;
	}

	protected function loadAndParse(string $fileName, ?string $currentFileName): array
	{
		$sanitizedFileName = $this->getStreamlinedFileName($fileName, $currentFileName);
		$content = $this->getFileContents($sanitizedFileName);

		if ( function_exists( 'yaml_parse')) {
			$content = $this->usePeclParser($content);
		} else {
			$content = $this->useSymfonyParser($content);
		}

		if (!is_array($content)) {
			throw new YamlParseException(
				'YAML file "' . $fileName . '" could not be parsed into valid syntax, probably empty?',
				1497332874
			);
		}

		if ($this->hasFlag(self::PROCESS_IMPORTS)) {
			$content = $this->processImports($content, $sanitizedFileName);
		}
		if ($this->hasFlag(self::PROCESS_PLACEHOLDERS)) {
			// Check for "%" placeholders
			$content = $this->processPlaceholders($content, $content);
		}
		return $content;
	}
}
