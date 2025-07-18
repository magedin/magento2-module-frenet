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

namespace MagedIn\Frenet\Model\Config\Source\Catalog\Product\Quote;

use MagedIn\Frenet\Model\Catalog\ProductType;

/**
 * Class ProductTypes
 */
class ProductTypes implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->toArray() as $code => $label) {
            $options[] = [
                'label' => $label,
                'value' => $code,
            ];
        }

        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $this->options = [
            ProductType::TYPE_SIMPLE       => __('Simple Products'),
            ProductType::TYPE_CONFIGURABLE => __('Configurable Products'),
            ProductType::TYPE_BUNDLE       => __('Bundle Products'),
            ProductType::TYPE_GROUPED      => __('Grouped Products'),
        ];

        return $this->options;
    }
}
