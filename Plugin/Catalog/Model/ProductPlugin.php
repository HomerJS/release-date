<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;
use Tarknaiev\ReleaseDate\Model\ReleaseDateData;

/**
 * Class ProductPlugin
 */
class ProductPlugin
{
    /**
     * @var ReleaseDateData
     */
    private ReleaseDateData $releaseDateData;

    /**
     * ProductPlugin constructor.
     * @param ReleaseDateData $releaseDateData
     */
    public function __construct(
        ReleaseDateData $releaseDateData
    ) {
        $this->releaseDateData = $releaseDateData;
    }

    /**
     * @param Product $object
     * @param $result
     * @return array|mixed
     */
    public function afterIsSaleable(Product $object, $result)
    {
       return $this->releaseDateData->prepareData((int) $object->getId()) != null ? [] : $result;
    }
}
