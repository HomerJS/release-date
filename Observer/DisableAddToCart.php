<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\InputException;
use Tarknaiev\ReleaseDate\Model\ReleaseDateData;

/**
 * Class DisableAddToCart
 */
class DisableAddToCart implements ObserverInterface
{
    /**
     * @var ReleaseDateData
     */
    private ReleaseDateData $releaseDateData;

    /**
     * DisableAddToCart constructor.
     * @param ReleaseDateData $releaseDateData
     */
    public function __construct(
        ReleaseDateData $releaseDateData
    ) {
        $this->releaseDateData = $releaseDateData;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Checkout\Model\Cart $cart */
        $cart = $observer->getCart();
        foreach ($cart->getItems() as $item) {
            $productId = (int) $item->getProductId();
            if ($this->releaseDateData->prepareData($productId) != null) {
                throw new InputException(__("Unfortunately, this product is not available now"));
            }
        }
    }
}
