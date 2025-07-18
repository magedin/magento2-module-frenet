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
declare(strict_types=1);

namespace MagedIn\Frenet\Block\Adminhtml\Form\Element;

use MagedIn\Frenet\Model\ModuleMetadata;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Escaper;

/**
 * Class Label
 * A customized label for using in admin form.
 */
class Label extends \Magento\Framework\Data\Form\Element\Label
{
    /**
     * @var ModuleMetadata
     */
    private ModuleMetadata $moduleMetadata;

    /**
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param ModuleMetadata $moduleMetadata
     * @param $data
     */
    public function __construct(
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        ModuleMetadata $moduleMetadata,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->moduleMetadata = $moduleMetadata;
    }

    /**
     * Get module's version. First try to get it from composer installation otherwise use the config information.
     *
     * @return string
     */
    public function getValue(): string
    {
        return (string) $this->moduleMetadata->getVersion() ?: $this->getData('version');
    }
}
