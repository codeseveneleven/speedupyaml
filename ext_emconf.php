<?php

/*
 * This file is part of the TYPO3 project.
 *
 * @author Frank Berger <fberger@code711.de>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

$EM_CONF[$_EXTKEY] = [
    'title' => '(Code711) Speed up YAML parsing',
    'description' => 'This extension provides an XCLASS for TYPO3\'CMS\\Core\\Configuration\\Loader\\YamlFileLoader to use the pecl extension YAML if available instead of the Symfonies\'s Yaml::parse. This should speed up the parsing of the siteconfig yaml and associated files. It does not touch EXT:form yaml files. This extension is experimental and a proof-of-concept. It might work in production.',
    'category' => 'plugin',
    'version' => '0.0.1',
    'state' => 'stable',
    'clearcacheonload' => 1,
    'author' => 'Frank Berger',
    'author_email' => 'fberger@code711.de',
    'author_company' => 'Code711, a label of Sudhaus7, B-Factor GmbH and 12bis3 GbR',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-13.99.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Code711\\Speedupyaml\\' => 'Classes',
        ],
    ],
];
