# TYPO3 speed up yaml parsing

[![Latest Stable Version](https://poser.pugx.org/code711/speedupyaml/v/stable.svg)](https://extensions.typo3.org/code711/speedupyaml/)
[![TYPO3 12](https://img.shields.io/badge/TYPO3-12-orange.svg)](https://get.typo3.org/version/12)
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-orange.svg)](https://get.typo3.org/version/11)
[![TYPO3 10](https://img.shields.io/badge/TYPO3-10-orange.svg)](https://get.typo3.org/version/10)
[![Total Downloads](https://poser.pugx.org/code711/speedupyaml/d/total.svg)](https://packagist.org/packages/code711/speedupyaml)
[![Monthly Downloads](https://poser.pugx.org/code711/speedupyaml/d/monthly)](https://packagist.org/packages/code711/speedupyaml)

This extension is a proof of concept but should work in production as well.

TYPO3 uses the [Symfony Yaml Component](https://symfony.com/doc/current/components/yaml.html) to parse YAML files. This is especially done in the TYPO3 Core class [TYPO3\\Core\\Configuration\\Loader\\YamlFileLoader](https://github.com/TYPO3-CMS/core/blob/main/Classes/Configuration/Loader/YamlFileLoader.php) using the Symfony `Yaml::parse` method.

Me - and others - were under the impression that `Yaml::parse` will fall back to the [PECL Yaml Extension](https://pecl.php.net/package/yaml) using [yaml_parse](https://www.php.net/yaml_parse) if available. 

***This is not the case, and seemingly never has been***

This extension will [XCLASS](https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Xclasses/Index.html) the TYPO3 core class `TYPO3\\Core\\Configuration\\Loader\\YamlFileLoader` and extend the method `TYPO3\\Core\\Configuration\\Loader\\YamlFileLoader::loadAndParse` so it will use the PECL yaml extension. 

The PECL yaml extension will then use the official YAML parser written in C, making the parsing of YAML files about 40% faster.

### Problems(?) / Limitations

The feature set of the PECL yaml extensions is different from the Symfony YAML Component, which does **not** cover the whole feature set of YAML, while the PECL extension does. This **COULD** lead to different results when parsing the same file.

Additionally, the Symfony Yaml Component might handle edge-cases differently than the PECL extension. I don't have enough examples what that might be, but in my TYPO3 centric tests everything resulted in the same parsed array.

This XCLASS will do nothing for EXT:forms. Helmut Hummels [helhum/typo3-config-handling](https://github.com/helhum/typo3-config-handling) does something similar, but only for the scope of the extension. I actually took my inspiration for handling the error-cases `yaml_parse` might throw from this extension as an example.

I will not publish this extension to the TER for now, as this is something that should be handled in the core itself.

It should work on TYPO3 10, 11 and 12 as the `TYPO3\\Core\\Configuration\\Loader\\YamlFileLoader` class did not change in the regards that matter for the case here over that time.
