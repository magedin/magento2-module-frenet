<?php
/**
 * MagedIn Technology
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  MagedIn
 * @copyright Copyright (c) 2025 MagedIn Technology.
 *
 * @author    MagedIn Support <support@magedin.com>
 */

declare(strict_types = 1);

namespace MagedIn\Frenet\Model;

use MagedIn\Frenet\Model\Packages\PackageItem;

/**
 * Interface CalculatorInterface
 */
interface CalculatorInterface
{
    /**
     * @return PackageItem[]
     */
    public function getQuote() : array;
}
