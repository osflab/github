<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\Stream;

/**
 * Ultra-light and secure twig-like template engine
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 2017
 * @package osf
 * @subpackage stream
 */
class TwigLight
{
    protected $templateSource;
    protected $cacheTimeout;
    protected $cacheKey;
    protected $updateCache;
    
    /**
     * FR: Moteur de template léger utilisant une syntaxe compatible avec twig
     * @param string $templateSource Contenu du template à utiliser
     * @param int $cacheTimeout Timeout de cache en secondes (0 = pas de cache)
     * @param string $cacheKey Clé du cache (null = auto mais plus lent)
     * @param bool $updateCache Force la génération du cache lors du premier render
     */
    public function __construct(string $templateSource, int $cacheTimeout = 0, string $cacheKey = null, bool $updateCache = false)
    {
        $this->templateSource = $templateSource;
        $this->cacheTimeout = $cacheTimeout;
        $this->cacheKey = $cacheKey;
        $this->updateCache = $updateCache;
    }
    
    /**
     * FR: Calcule un rendu avec les valeurs passées en paramètre
     * @param array $values Valeurs à utiliser
     * @param bool $debug Affiche des informations de débogage en cas de problème
     * @return string
     */
    public function render(array $values, bool $debug = false)
    {
        $vals = $this->compileValues($values);
        return str_replace(array_keys($vals), array_values($vals), $this->templateSource);
    }
    
    /**
     * FR: Transforme le tableau de valeurs pour le remplacement
     * @param array $values
     * @param string $prefix Utilisé pour la récursivité
     * @return array
     */
    protected function compileValues(array $values, $prefix = '')
    {
        $retVal = [];
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $retVal = array_merge($retVal, $this->compileValues($value, $prefix . $key . '.'));
            } else {
                $retVal['{{' . $prefix . $key . '}}'] = $value;
            }
        }
        return $retVal;
    }
    
    /**
     * FR: Compilation express d'un template avec des valeurs
     * @param string $templateSource
     * @param array $values
     * @return string
     */
    public static function quickRender(string $templateSource, array $values)
    {
        return (new self($templateSource))->render($values);
    }
}
