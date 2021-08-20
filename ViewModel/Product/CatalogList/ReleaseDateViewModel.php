<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\ViewModel\Product\CatalogList;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Tarknaiev\ReleaseDate\Block\Product\ReleaseDate\ReleaseDateFactory;

/**
 * Class ReleaseDateViewModel
 */
class ReleaseDateViewModel implements ArgumentInterface
{
    /**
     * @var ReleaseDateFactory
     */
    private ReleaseDateFactory $releaseDateFactory;

    /**
     * ReleaseDateViewModel constructor.
     * @param ReleaseDateFactory $releaseDateFactory
     */
    public function __construct(
        ReleaseDateFactory $releaseDateFactory
    ) {
        $this->releaseDateFactory = $releaseDateFactory;
    }

    /**
     * @param int $productId
     * @return string|null
     */
    public function getReleaseDateHtml(int $productId):? string
    {
        return $this->releaseDateFactory->getReleaseHtml($productId);
    }
}
