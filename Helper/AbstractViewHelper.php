<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\View\Helper;

use Osf\Exception\ArchException;
use Zend\View\Renderer\RendererInterface;

/**
 * FR: Utiliser ce trait dans les autres traits d'aide de vue pour récupérer la vue courant
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 16 nov. 2013
 * @package osf
 * @subpackage view
 */
abstract class AbstractViewHelper implements ViewHelperInterface
{
    protected $lines = [];
    protected $escape = true;
    
    /**
     * Current view
     * @var \Osf\View\OsfView
     */
    public function getView()
    {
        if (!isset($this->view) || !($this->view instanceof \Osf\View\OsfView)) {
            throw new ArchException('This trait must be used in a view context');
        }
        return $this->view;
    }

    /**
     * Set the View object
     * @param  Renderer $view
     * @return HelperInterface
     */
    public function setView(RendererInterface $view)
    {
        $this->view = $view;
        return $this;
    }
    
    /**
     * FR: Cumule du code HTML dans le but de le restituer
     * @param string $newLine
     * @param bool $condition ignored if false
     * @return $this
     */
    protected function html($newLine, $condition = true)
    {
        if ($condition) {
            $this->lines[] = ltrim($newLine);
        }
        return $this;
    }
    
    /**
     * FR: Restitue le code HTML dans un format correspondant à l'environnement
     * Et réinitialise le escape
     * @return string
     */
    protected function getHtml()
    {
        array_walk($this->lines, 'trim');
        $html = trim(implode('', $this->lines));
        $this->lines = [];
        return $html;
    }
    
    /**
     * Escape a value for html display
     * @param string $value
     * @return string
     */
    protected function esc($value)
    {
        return $this->escape ? htmlspecialchars($value) : $value;
    }
    
    /**
     * Disable values escaping if contains HTML. 
     * You must escape value before using the helper.
     * @return $this
     */
    public function disableEscape()
    {
        $this->escape = false;
        return $this;
    }

    /**
     * Call each reset<Trait> method if exists
     * @param array $args
     * @return $this
     */
    protected function initValues(array $args)
    {
        $uses = class_uses(get_class($this));
        foreach ($uses as $use) {
            $resetMethod = 'init' . basename(strtr($use, '\\', '/'));
            if (method_exists($this, $resetMethod)) {
                $this->$resetMethod($args);
            }
        }
        return $this;
    }

    /**
     * Call the render method of child class to render item
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
