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

use MagedIn\Frenet\Model\Config;
use MagedIn\Frenet\Model\Cache\CacheKeyGeneratorInterface;
use MagedIn\Frenet\Model\Formatters\PostcodeNormalizer;
use MagedIn\Frenet\Service\RateRequestProvider;
use Magento\Framework\Serialize\SerializerInterface;

class PostcodeGenerator implements CacheKeyGeneratorInterface
{
    /**
     * @var RateRequestProvider
     */
    private $requestProvider;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var PostcodeNormalizer
     */
    private $postcodeNormalizer;

    public function __construct(
        PostcodeNormalizer $postcodeNormalizer,
        SerializerInterface $serializer,
        RateRequestProvider $requestProvider,
        Config $config
    ) {
        $this->serializer = $serializer;
        $this->requestProvider = $requestProvider;
        $this->config = $config;
        $this->postcodeNormalizer = $postcodeNormalizer;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        $destPostcode = $this->requestProvider->getRateRequest()->getDestPostcode();
        $origPostcode = $this->config->getOriginPostcode();

        return $this->postcodeNormalizer->format($destPostcode) . '-' .
            $this->postcodeNormalizer->format($origPostcode);
    }
}
