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

namespace MagedIn\Frenet\Model\Cache\CacheKeyGenerator;

use MagedIn\Frenet\Model\Cache\CacheKeyGeneratorInterface;
use MagedIn\Frenet\Model\Quote\ItemQuantityCalculatorInterface;
use MagedIn\Frenet\Model\Quote\QuoteItemValidatorInterface;
use MagedIn\Frenet\Service\RateRequestProvider;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Quote\Model\Quote\Item\AbstractItem as QuoteItem;

class QuoteItemGenerator implements CacheKeyGeneratorInterface
{
    /**
     * @var RateRequestProvider
     */
    private RateRequestProvider $requestProvider;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var QuoteItemValidatorInterface
     */
    private QuoteItemValidatorInterface $quoteItemValidator;

    /**
     * @var ItemQuantityCalculatorInterface
     */
    private ItemQuantityCalculatorInterface $itemQtyCalculator;

    public function __construct(
        SerializerInterface $serializer,
        RateRequestProvider $requestProvider,
        QuoteItemValidatorInterface $quoteItemValidator,
        ItemQuantityCalculatorInterface $itemQtyCalculator
    ) {
        $this->serializer = $serializer;
        $this->requestProvider = $requestProvider;
        $this->quoteItemValidator = $quoteItemValidator;
        $this->itemQtyCalculator = $itemQtyCalculator;
    }

    /**
     * @inheritDoc
     * @throws LocalizedException
     */
    public function generate(): string
    {
        $items = [];

        /** @var QuoteItem $item */
        foreach ($this->requestProvider->getRateRequest()->getAllItems() as $item) {
            if (!$this->quoteItemValidator->validate($item)) {
                continue;
            }

            $productId = (int) $item->getProductId();

            if ($item->getParentItem()) {
                $productId = $item->getParentItem()->getProductId() . '-' . $productId;
            }

            $qty = (float) $this->itemQtyCalculator->calculate($item);

            $items[$productId] = $qty;
        }

        ksort($items);

        return $this->serializer->serialize($items);
    }
}
