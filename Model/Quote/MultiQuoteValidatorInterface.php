<?php
/**
 * MagedIn Technology
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  MagedIn
 * @copyright Copyright (c) 2024 MagedIn Technology.
 *
 * @author    MagedIn Support <support@magedin.com>
 */

declare(strict_types = 1);

namespace MagedIn\Frenet\Model\Quote;

/**
 * Class MultiQuoteValidatorInterface
 */
interface MultiQuoteValidatorInterface
{
    /**
     * @return bool
     */
    public function canProcessMultiQuote() : bool;
}
