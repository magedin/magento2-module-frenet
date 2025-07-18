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

namespace MagedIn\Frenet\Model\Cache;

use Magento\Framework\Serialize\SerializerInterface;

class CacheKeyGenerator implements CacheKeyGeneratorInterface
{
    /**
     * @var array
     */
    private array $generators;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @param SerializerInterface $serializer
     * @param array $generators
     */
    public function __construct(
        SerializerInterface $serializer,
        array $generators = []
    ) {
        $this->serializer = $serializer;
        $this->generators = $generators;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $cacheKey = [];
        /** @var CacheKeyGeneratorInterface $generator */
        foreach ($this->generators as $generator) {
            $cacheKey[] = $generator->generate();
        }
        return $this->serializer->serialize($cacheKey);
    }
}
