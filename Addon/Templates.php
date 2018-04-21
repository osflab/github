<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\Github\Addon;

use Osf\Stream\Text;

/**
 * Composer templates
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-3.0.0 - 2018
 * @package osf
 * @subpackage github
 */
trait Templates
{
    protected static function getFrameworkComposerTemplate(): array
    {
        return [
            'name' => 'osflab/osf',
            'description' => 'OpenStates Framework',
            'version' => '3.0.2-dev',
            'type' => 'library',
            'keywords' => [],
            'homepage' => 'https://github.com/osflab/osf',
            'license' => 'AGPL-3.0-or-later',
            'authors' => [
                [
                    'name' => 'Guillaume Ponçon',
                    'email' => 'guillaume.poncon@openstates.com'
                ]
            ],
            'support' => [
                'issues' => 'https://github.com/osflab/osf/issues',
                'source' => 'https://github.com/osflab/osf',
            ],
            'require' => [
                'php' => '^7.1.3'
            ],
            'require-dev' => [],
            'conflict' => [],
            'replace' => [],
            'provide' => [],
            'suggest' => [],
            'minimum-stability' => 'dev',
            'prefer-stable' => true,
            'autoload' => [
                'psr-4' => [
                    'Osf\\' => 'src'
                ]
            ],
        ];
    }
    
    protected static function getComponentComposerTemplate(string $component): array
    {
        $componentLower = Text::fromCamelCaseToLower($component);
        return [
            'name' => 'osflab/' . $componentLower,
            'description' => '',
            'version' => '3.0.1-dev',
            'type' => 'library',
            'keywords' => [],
            'homepage' => 'https://github.com/osflab/' . $componentLower,
            'license' => 'AGPL-3.0-or-later',
            'authors' => [
                [
                    'name' => 'Guillaume Ponçon',
                    'email' => 'guillaume.poncon@openstates.com'
                ]
            ],
            'support' => [
                'issues' => 'https://github.com/osflab/' . $componentLower . '/issues',
                'source' => 'https://github.com/osflab/' . $componentLower,
            ],
            'require' => [
                'php' => '^7.1.3'
            ],
            'require-dev' => [],
            'conflict' => [],
            'replace' => [],
            'provide' => [],
            'suggest' => [],
            'minimum-stability' => 'dev',
            'prefer-stable' => true,
            'autoload' => [
                'psr-4' => [
                    'Osf\\' . $component . '\\' => ''
                ]
            ],
        ];
    }
}
