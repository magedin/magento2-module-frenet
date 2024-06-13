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
