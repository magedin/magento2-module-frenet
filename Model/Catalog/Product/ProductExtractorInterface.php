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

namespace MagedIn\Frenet\Model\Catalog\Product;

use Magento\Catalog\Model\Product;

/**
 * Interface ProductExtractorInterface
 */
interface ProductExtractorInterface extends DimensionsExtractorInterface
{
    /**
     * @param Product $product
     *
     * @return $this
     */
    public function setProduct(Product $product) : self;
}
