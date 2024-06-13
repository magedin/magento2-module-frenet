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

namespace MagedIn\Frenet\Block\Form\Element;

/**
 * Class Label
 * A customized label for using in admin form.
 */
class Label extends \Magento\Framework\Data\Form\Element\Label
{
    /**
     * @var \MagedIn\Frenet\Model\ModuleMetadata
     */
    private $moduleMetadata;

    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \MagedIn\Frenet\Model\ModuleMetadata $moduleMetadata,
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
    public function getValue() : string
    {
        return (string) $this->moduleMetadata->getVersion() ?: $this->getData('version');
    }
}
