<?php
/**
 * Frenet Shipping Gateway
 *
 * @category Frenet
 * @package  MagedIn\Frenet
 *
 * @author   Tiago Sampaio <tiago@tiagosampaio.com>
 * @link     https://github.com/tiagosampaio
 * @link     https://tiagosampaio.com
 *
 * Copyright (c) 2020.
 */

namespace MagedIn\Frenet\Api;

use MagedIn\Frenet\Api\Data\ProductQuoteOptionsInterface;

interface QuoteProductInterface
{
    /**
     * @param int    $id
     * @param string $postcode
     * @param int    $qty
     * @param array  $options
     *
     * @return array
     */
    public function quoteByProductId(int $id, string $postcode, int $qty = 1, array $options = []) : array;

    /**
     * @param string $sku
     * @param string $postcode
     * @param int    $qty
     * @param array  $options
     *
     * @return array
     */
    public function quoteByProductSku(string $sku, string $postcode, int $qty = 1, array $options = []) : array;
}
