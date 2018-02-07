<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View;

use Zend\View\Helper\HelperInterface as ZendHelperInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

/**
 * Interface for helper classess
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 2017
 * @package osf
 * @subpackage view
 * @todo [HELPERS] codé rapidement, à refactorer... 
 */
interface HelperInterface
{
    /**
     * Register a set of callable helpers
     * @param array $helpers
     */
    public function registerHelpers(array $helpers);
    
    /**
     * Dynamic call of external helpers
     * @param string $helper
     * @param array $params
     * @throws ArchException
     * @return mixed
     */
    public function __get($helper);

    public function __call($helper, $params);
    
    /**
     * Set the View object
     * @param  Renderer $view
     * @return ZendHelperInterface
     */
    public function setView(Renderer $view);

    /**
     * Get the View object
     * @return \Osf\View\OsfView
     */
    public function getView();
    
    /**
     * FR: Généré par OsfGenerator
     * @return array
     */
    public static function getAvailableHelpers();
    
    public function init();
    
    /**
     * Escape a string (htmlspecialchars)
     * @param string $txt
     * @return string
     */
    public function htmlEscape($txt);
    
    /**
     * Escape a string from view params value
     * @param string $key
     * @return string
     */
    public function getHtmlEscape($key, $alternateContent = '');
    
    /**
     * Get a value from action controller
     * @param string $key
     * @param string $alternateContent displayd if $key not found
     * @return multitype:
     */
    public function get($key, $alternateContent = '');
    
    /**
     * Get registered values in the current view
     * @return array:
     */
    public function getValues();
    
    /**
     * FR: Simule isset sur propriété dynamique
     * @param string $key
     */
    public function __isset($key);
}
