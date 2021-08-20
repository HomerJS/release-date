<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Block\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tarknaiev\ReleaseDate\Block\Product\ReleaseDate\ReleaseDateFactory;

/**
 * Class ShowReleaseDate
 */
class ShowReleaseDate extends Template implements IdentityInterface
{
    const CACHE_TAG = 'release_date_block';

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var ReleaseDateFactory
     */
    private ReleaseDateFactory $releaseDateFactory;

    /**
     * ShowReleaseDate constructor.
     * @param Context $context
     * @param ProductRepositoryInterface $productRepository
     * @param ReleaseDateFactory $releaseDateFactory
     * @param array $data
     */
    public function __construct (
        Context $context,
        ProductRepositoryInterface $productRepository,
        ReleaseDateFactory $releaseDateFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->releaseDateFactory = $releaseDateFactory;
    }

    /**
     * @return int|null
     */
    public function getProductId():? int
    {
        return (int) $this->getRequest()->getParam('id') ?? null;
    }

    /**
     * @return ProductInterface|null
     */
    public function getProduct():? ProductInterface
    {
        $productId = $this->getProductId();
        if (!$productId) {
            return null;
        }
        try {
            return $this->productRepository->getById($productId);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getReleaseDateHtml():? string
    {
        $productId = (int) $this->getProductId();
        return $this->releaseDateFactory->getReleaseHtml($productId);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getBlockId()];
    }
}
