<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View\Helper\Bootstrap\Addon;

use Osf\View\Helper\Bootstrap\Tools\Checkers;
use Osf\Container\OsfContainer as Container;

/**
 * Tooltip addon (FR: infobulle)
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 2017
 * @package osf
 * @subpackage view
 */
trait Tooltip
{
    protected $tooltip;
    protected $tooltipOptions = [];
    
    /**
     * FR: Bulle d'aide (infobulle)
     * @param string $txt
     * @param string $placement top, bottom, left, right
     * @param bool $html pour mettre du HTML plutôt que du texte
     * @param string $container 'body' ou nom de balise ou rattacher l'infobulle
     * @param int $delay délai de l'animation (ms) 
     * @return $this
     */
    public function setTooltip($txt, $placement = null, $html = null, $container = null, $delay = null)
    {
        if (Container::getDevice()->isMobileOrTablet()) {
            return $this;
        }
        if ($txt === null || $txt === '') {
            $this->tooltip = null;
            $this->tooltipOptions = [];
        }
        $this->tooltip = (string) $txt;
        $placement !== null && Checkers::checkPlacement($placement);
        $placement !== null && $this->tooltipOptions['data-placement'] = $placement;
        $html      !== null && $this->tooltipOptions['data-html'] = (int) (bool) $html;
        $container !== null && $this->tooltipOptions['data-container'] = (string) $container;
        $delay     !== null && $this->tooltipOptions['data-delay'] = (int) $delay;
        return $this;
    }
    
    /**
     * Attributes to add to an element
     * @return array
     */
    public function getTooltipAttributes():array
    {
        if ($this->tooltip !== null) {
            $attrs = $this->tooltipOptions;
            $attrs['data-toggle'] = 'tooltip';
            $attrs['title'] = $this->tooltip;
            return $attrs;
        }
        return [];
    }
    
    protected function initTooltip(array $vars)
    {
        if (isset($vars['tooltip'])) {
            $this->setTooltip($vars['tooltip']);
        } else {
            $this->tooltip = null;
        }
    }
}
