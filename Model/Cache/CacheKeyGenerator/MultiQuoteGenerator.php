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

namespace MagedIn\Frenet\Model\Cache\CacheKeyGenerator;

use MagedIn\Frenet\Model\Cache\CacheKeyGeneratorInterface;
use MagedIn\Frenet\Model\Config;

class MultiQuoteGenerator implements CacheKeyGeneratorInterface
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        return $this->config->isMultiQuoteEnabled() ? 'multi' : 'single';
    }
}
