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

use MagedIn\Frenet\Model\Catalog\ProductType;
use Magento\Quote\Model\Quote\Item\AbstractItem as QuoteItem;

/**
 * Class ItemQuantityCalculator
 */
class ItemQuantityCalculator implements ItemQuantityCalculatorInterface
{
    /**
     * @param QuoteItem $item
     *
     * @return float
     */
    public function calculate(QuoteItem $item)
    {
        $type = $item->getProductType();

        if ($item->getParentItem()) {
            $type = $item->getParentItem()->getProductType();
        }

        switch ($type) {
            case ProductType::TYPE_BUNDLE:
                $qty = $this->calculateBundleProduct($item);
                break;

            case ProductType::TYPE_GROUPED:
                $qty = $this->calculateGroupedProduct($item);
                break;

            case ProductType::TYPE_CONFIGURABLE:
                $qty = $this->calculateConfigurableProduct($item);
                break;

            case ProductType::TYPE_VIRTUAL:
            case ProductType::TYPE_DOWNLOADABLE:
            case ProductType::TYPE_SIMPLE:
            default:
                $qty = $this->calculateSimpleProduct($item);
        }

        return (float) max(1, $qty);
    }

    /**
     * @param QuoteItem $item
     *
     * @return float
     */
    private function calculateSimpleProduct(QuoteItem $item)
    {
        return (float) $item->getQty();
    }

    /**
     * @param QuoteItem $item
     *
     * @return float
     */
    private function calculateBundleProduct(QuoteItem $item)
    {
        $bundleQty = (float) $item->getParentItem()->getQty();
        return (float) $item->getQty() * $bundleQty;
    }

    /**
     * @param QuoteItem $item
     *
     * @return float
     */
    private function calculateGroupedProduct(QuoteItem $item)
    {
        return (float) $item->getQty();
    }

    /**
     * The right quantity for configurable products are on the parent item.
     *
     * @param QuoteItem $item
     *
     * @return float
     */
    private function calculateConfigurableProduct(QuoteItem $item)
    {
        return (float) $item->getParentItem()->getQty();
    }
}
