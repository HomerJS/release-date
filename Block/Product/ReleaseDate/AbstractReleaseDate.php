<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Block\Product\ReleaseDate;

use Magento\Framework\View\Element\Template;
use Tarknaiev\ReleaseDate\Model\ReleaseDateData;

/**
 * Class AbstractReleaseDate
 */
abstract class AbstractReleaseDate extends Template
{
    const PRODUCT_ID = "product_id";

    /**
     * @var null
     */
    protected $_template = null;

    /**
     * @var ReleaseDateData
     */
    protected ReleaseDateData $releaseDateData;

    /**
     * AbstractReleaseDate constructor.
     * @param Template\Context $context
     * @param ReleaseDateData $releaseDateData
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ReleaseDateData $releaseDateData,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->releaseDateData = $releaseDateData;
    }

    /**
     * @param int $productId
     * @return string|null
     */
    public function prepareReleaseDateHtml(int $productId): ?string
    {
        $this->setData(self::PRODUCT_ID, $productId);
        if ($this->getReleaseDateData() == null) {
            return null;
        }
        return $this->toHtml();
    }

    /**
     * @return string|null
     */
    public function getReleaseDateData():? string
    {
        $productId = $this->getData(self::PRODUCT_ID);
        return $this->releaseDateData->prepareData($productId);
    }
}
