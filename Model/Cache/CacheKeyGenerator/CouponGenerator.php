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

namespace MagedIn\Frenet\Model\Cache\CacheKeyGenerator;

use MagedIn\Frenet\Model\Cache\CacheKeyGeneratorInterface;
use MagedIn\Frenet\Model\Quote\CouponProcessor;

class CouponGenerator implements CacheKeyGeneratorInterface
{
    /**
     * @var CouponProcessor
     */
    private $couponProcessor;

    public function __construct(
        CouponProcessor $couponProcessor
    ) {
        $this->couponProcessor = $couponProcessor;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        return $this->couponProcessor->getCouponCode() ?: 'no-coupon';
    }
}
