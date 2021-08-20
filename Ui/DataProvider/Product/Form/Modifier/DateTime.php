<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Tarknaiev\ReleaseDate\Api\Data\ReleaseAttributeInterface;

/**
 * Class DateTime
 */
class DateTime extends AbstractModifier
{
    /**
     * @var ArrayManager
     */
    private ArrayManager $arrayManager;

    /**
     * DateTime constructor.
     * @param ArrayManager $arrayManager
     */
    public function __construct(
        ArrayManager $arrayManager
    ) {
        $this->arrayManager = $arrayManager;
    }

    /**
     * @inheritDoc
     */
    public function modifyData(array $data): array
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta(array $meta): array
    {
        $fieldCode = ReleaseAttributeInterface::RELEASE_DATE_CUSTOM_ATTRIBUTE;

        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCode, $meta, null, 'children');

        if (!$elementPath) {
            return $meta;
        }

        return $this->arrayManager->merge(
            $containerPath,
            $meta,
            [
                'children'  => [
                    $fieldCode => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'default' => '',
                                    'options'       => [
                                        'dateFormat' > 'Y-m-d',
                                        'timeFormat' => 'HH:mm:ss',
                                        'showsTime' => true
                                    ]
                                ],
                            ],
                        ],
                    ]
                ]
            ]
        );
    }
}
