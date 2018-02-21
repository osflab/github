<?php

/*
 * This file is part of the OpenStates Framework (osf) package.
 * (c) Guillaume Ponçon <guillaume.poncon@openstates.com>
 * For the full copyright and license information, please read the LICENSE file distributed with the project.
 */

namespace Osf\Crypt;

use Osf\Crypt\Crypt;
use Osf\Test\Runner as OsfTest;

/**
 * Crypt unit tests
 *
 * @author Guillaume Ponçon <guillaume.poncon@openstates.com>
 * @copyright OpenStates
 * @version 1.0
 * @since OSF-2.0 - 14 sept. 2013
 * @package osf
 * @subpackage test
 * @todo need to work without trim()
 */
class Test extends OsfTest
{
    public static function run()
    {
        self::reset();
        
        self::assert(in_array(Crypt::CIPHER_METHOD, openssl_get_cipher_methods()), 'Cipher method ' . Crypt::CIPHER_METHOD . ' not available');
        
        $cryptObj = new Crypt('THE CRYPT PHRASE');
        $encrypted = $cryptObj->encrypt('Bonjour le monde');
        
        self::assert($encrypted == 'lGITvRQmmZfLaFqC3J8kysxxuGUBa8YIvGAT2/9QIF0=', 'No expected encrypted string');
        self::assert(trim($cryptObj->decrypt($encrypted)) == 'Bonjour le monde', 'Wrong bijectivity');
        
        self::assert(preg_match('/^[a-f0-9]{8}$/', $cryptObj->getRandomHash()));
        self::assert(preg_match('/^[a-f0-9]{64}$/', $cryptObj->getRandomHash(true)));
        
        return self::getResult();
    }
}
