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

namespace MagedIn\Frenet\Setup\Patch\Data;

use MagedIn\Frenet\Model\Cache\Type\Frenet;
use Magento\Framework\Console\Cli;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class FrenetQuotePatchData implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var Frenet
     */
    protected $cacheType;

    /**
     * @var AttributeContainer
     */
    protected $attributeContainer;

    /**
     * @var EavAttributeInstaller
     */
    private $attributeInstaller;

    /**
     * Constructor
     *
     * @param Frenet $cacheType
     * @param AttributeContainer                       $attributeContainer
     * @param EavAttributeInstaller                    $attributeInstaller
     */
    public function __construct(
        Frenet $cacheType,
        AttributeContainer $attributeContainer,
        EavAttributeInstaller $attributeInstaller
    ) {
        $this->cacheType = $cacheType;
        $this->attributeContainer = $attributeContainer;
        $this->attributeInstaller = $attributeInstaller;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        /**
         * Run for new installation only.
         */
        $this->configureNewInstallation();
        return Cli::RETURN_SUCCESS;
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getVersion()
    {
        return '2.4.6';
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Creates the new attributes during the module installation.
     */
    private function configureNewInstallation()
    {
        /**
         * @var string $code
         * @var array  $data
         */
        foreach ($this->attributeContainer->getAttributeProperties() as $code => $data) {
            $this->attributeInstaller->install($code, (array) $data);
        }

        /** Set the Frenet cache type enabled by default when module is installed. */
        $this->cacheType->setEnabled(true);
    }
}
