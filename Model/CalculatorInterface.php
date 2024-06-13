<?php
/**
 * Frenet Shipping Gateway
 *
 * @category Frenet
 *
 * @author Tiago Sampaio <tiago@tiagosampaio.com>
 * @link https://github.com/tiagosampaio
 * @link https://tiagosampaio.com
 *
 * Copyright (c) 2020.
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
