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

namespace MagedIn\Frenet\Test\Unit\Service;

use MagedIn\Frenet\Service\RateRequestProvider;
use MagedIn\Frenet\Test\Unit\TestCase;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Address\RateRequest;
use PHPUnit\Framework\MockObject\MockObject;

class RateRequestProviderTest extends TestCase
{
    /**
     * @var RateRequestProvider
     */
    private $rateRequestProvider;

    protected function setUp(): void
    {
        $this->rateRequestProvider = $this->getObject(RateRequestProvider::class);
    }

    /**
     * @test
     */
    public function setRateRequest()
    {
        /** @var RateRequest | MockObject $rateRequest */
        $rateRequest = $this->createMock(RateRequest::class);
        $this->assertInstanceOf(
            RateRequestProvider::class,
            $this->rateRequestProvider->setRateRequest($rateRequest)
        );
    }

    /**
     * @test
     */
    public function getRateRequest()
    {
        /** @var RateRequest | MockObject $rateRequest */
        $rateRequest = $this->createMock(RateRequest::class);
        $rateRequest->method('getData')->willReturn(9.9988);
        $this->rateRequestProvider->setRateRequest($rateRequest);
        $this->assertInstanceOf(
            RateRequest::class,
            $this->rateRequestProvider->getRateRequest()
        );
        $this->assertEquals(
            9.9988,
            $this->rateRequestProvider->getRateRequest()->getData()
        );
    }

    /**
     * @test
     */
    public function clear()
    {
        /** @var RateRequest | MockObject $rateRequest */
        $rateRequest = $this->createMock(RateRequest::class);
        $this->rateRequestProvider->setRateRequest($rateRequest);
        $this->rateRequestProvider->clear();
        $this->expectExceptionObject($this->getObject(LocalizedException::class, [
            'phrase' => __('Test')
        ]));
        $this->expectExceptionMessage('Rate Request is not set.');
        $this->rateRequestProvider->getRateRequest();
    }
}
