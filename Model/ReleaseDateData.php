<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Tarknaiev\ReleaseDate\Api\Data\ReleaseAttributeInterface;
use Tarknaiev\ReleaseDate\Helper\Config;
use Tarknaiev\ReleaseDate\Helper\Time;

/**
 * Class ReleaseDateData
 */
class ReleaseDateData
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var Config
     */
    private Config $configHelper;

    /**
     * @var Time
     */
    private Time $timeHelper;

    /**
     * ReleaseDateData constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param Config $configHelper
     * @param Time $timeHelper
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        Config $configHelper,
        Time $timeHelper
    ) {
        $this->productRepository = $productRepository;
        $this->configHelper = $configHelper;
        $this->timeHelper = $timeHelper;
    }

    /**
     * @param int $productId
     * @return string|null
     */
    public function prepareData(int $productId):? string
    {
        $product = $this->getProduct($productId);
        if ($product == null) {
            return null;
        }
        $attributeValue = $this->getAttributeValue($product);

        return $attributeValue != null
        && $this->configHelper->isEnabled()
        && $this->timeHelper->hasLeftTime($attributeValue)
            ? $this->timeHelper->prepareCurrentDate($attributeValue)
            : null;
    }

    /**
     * @param ProductInterface $product
     * @return string|null
     */
    public function getAttributeValue(ProductInterface $product):? string
    {
        $attribute = $product->getCustomAttribute(ReleaseAttributeInterface::RELEASE_DATE_CUSTOM_ATTRIBUTE);
        if ($attribute == null) {
            return null;
        }
        return $attribute->getValue();
    }

    /**
     * @param int $productId
     * @return ProductInterface|null
     */
    public function getProduct(int $productId):? ProductInterface
    {
        try {
            return $this->productRepository->getById($productId);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }
}
