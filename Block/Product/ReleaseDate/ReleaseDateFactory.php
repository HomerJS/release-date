<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Block\Product\ReleaseDate;

use Magento\Framework\ObjectManagerInterface;
use Tarknaiev\ReleaseDate\Helper\Config;

/**
 * Class ReleaseDateFactory
 */
class ReleaseDateFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private ObjectManagerInterface $objectManager;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * ReleaseDateFactory constructor.
     * @param ObjectManagerInterface $objectManager
     * @param Config $config
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        Config $config
    ) {
        $this->objectManager = $objectManager;
        $this->config = $config;
    }

    /**
     * @param int $productId
     * @return string|null
     */
    public function getReleaseHtml(int $productId):? string
    {
        $object = $this->getTypeObject();
        if (!is_object($object)) {
            return null;
        }

        return $object->prepareReleaseDateHtml($productId);
    }

    /**
     * @return AbstractReleaseDate
     */
    protected function getTypeObject(): AbstractReleaseDate
    {
        $type = $this->config->getMessageType();
        $className = 'Tarknaiev\\ReleaseDate\\Block\\Product\\ReleaseDate\\' . ucfirst($type) . "ReleaseDate";
        return $this->objectManager->create($className);
    }
}
