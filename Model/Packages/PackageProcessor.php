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

namespace MagedIn\Frenet\Model\Packages;

use Frenet\ObjectType\Entity\Shipping\Quote\Service;
use MagedIn\Frenet\Model\Quote\QuoteItemValidatorInterface;
use MagedIn\Frenet\Model\ApiServiceInterface;
use MagedIn\Frenet\Model\Config;
use MagedIn\Frenet\Model\Quote\CouponProcessor;
use MagedIn\Frenet\Model\TotalsCollector;
use MagedIn\Frenet\Service\RateRequestProvider;
use Magento\Quote\Model\Quote\Address\RateRequest;

/**
 * Class PackageProcessor
 */
class PackageProcessor
{
    /**
     * @var ApiServiceInterface
     */
    private $apiService;

    /**
     * @var \Frenet\Command\Shipping\QuoteInterface
     */
    private $serviceQuote;

    /**
     * @var QuoteItemValidatorInterface
     */
    private $quoteItemValidator;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var CouponProcessor
     */
    private $quoteCouponProcessor;

    /**
     * @var RateRequestProvider
     */
    private $rateRequestProvider;

    /**
     * @var TotalsCollector
     */
    private $totalsCollector;

    public function __construct(
        QuoteItemValidatorInterface $quoteItemValidator,
        Config $config,
        ApiServiceInterface $apiService,
        RateRequestProvider $rateRequestProvider,
        CouponProcessor $quoteCouponProcessor,
        TotalsCollector $totalsCollector
    ) {
        $this->apiService = $apiService;
        $this->quoteItemValidator = $quoteItemValidator;
        $this->config = $config;
        $this->rateRequestProvider = $rateRequestProvider;
        $this->quoteCouponProcessor = $quoteCouponProcessor;
        $this->totalsCollector = $totalsCollector;
    }

    /**
     * @param Package $package
     *
     * @return Service[]
     */
    public function process(Package $package) : array
    {
        $this->initServiceQuote();
        $this->calculateShipmentInvoiceValue($package);

        /** @var PackageItem $packageItem */
        foreach ($package->getItems() as $packageItem) {
            if (!$this->quoteItemValidator->validate($packageItem->getCartItem())) {
                continue;
            }

            $this->addPackageItemToQuote($packageItem);
        }

        return $this->callService();
    }

    /**
     * @param Package $package
     *
     * @return $this
     */
    private function calculateShipmentInvoiceValue(Package $package)
    {
        $totalPrice = $package->getTotalPrice();
        $totalPrice += $this->totalsCollector->calculateQuoteAdditions();
        $totalPrice -= $this->totalsCollector->calculateQuoteDiscounts();
        $this->serviceQuote->setShipmentInvoiceValue($totalPrice);
        return $this;
    }

    /**
     * @param PackageItem $packageItem
     *
     * @return $this
     */
    private function addPackageItemToQuote(PackageItem $packageItem): self
    {
        $this->serviceQuote->addShippingItem(
            $packageItem->getSku(),
            $packageItem->getQty(),
            $packageItem->getWeight(),
            $packageItem->getLength(),
            $packageItem->getHeight(),
            $packageItem->getWidth(),
            $packageItem->getProductCategories(),
            $packageItem->isProductFragile()
        );

        return $this;
    }

    /**
     * @return Service[]
     */
    private function callService(): array
    {
        /** @var \Frenet\ObjectType\Entity\Shipping\Quote $result */
        $result = $this->serviceQuote->execute();
        $services = $result->getShippingServices();

        return $services ?: [];
    }

    /**
     * @return $this
     */
    private function initServiceQuote(): self
    {
        /** @var RateRequest $rateRequest */
        $rateRequest = $this->rateRequestProvider->getRateRequest();

        /** @var \Frenet\Command\Shipping\QuoteInterface $quote */
        $this->serviceQuote = $this->apiService->shipping()->quote();
        $this->serviceQuote->setSellerPostcode($this->config->getOriginPostcode())
            ->setRecipientPostcode($rateRequest->getDestPostcode())
            ->setRecipientCountry($rateRequest->getDestCountryId());

        $this->quoteCouponProcessor->applyCouponCode($this->serviceQuote);

        return $this;
    }
}
