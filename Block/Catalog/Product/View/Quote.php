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
declare(strict_types=1);

namespace MagedIn\Frenet\Block\Catalog\Product\View;

use MagedIn\Frenet\ViewModel\Catalog\Product\View\Quote as ViewModel;
use Magento\Catalog\Block\Product\View;

/**
 * Class Quote
 *
 * @method ViewModel getViewModel
 *
 * @package MagedIn\Frenet\Block\Catalog\Product\View
 */
class Quote extends View
{
    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        parent::_construct();
        $this->getViewModel()->setBlock($this);
    }

    /**
     * @return array
     */
    public function getValidators()
    {
        return [
            'required-number' => true
        ];
    }

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _beforeToHtml()
    {
        $this->jsLayout['components']['frenet-quote']['config']['url'] = $this->getViewModel()->getUrl();
        parent::_beforeToHtml();
    }

    /**
     * @return string
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _toHtml() : string
    {
        if (!$this->getViewModel()->isProductQuoteAllowed()) {
            return '';
        }

        return parent::_toHtml();
    }
}
