<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class MessageType
 */
class MessageType implements OptionSourceInterface
{
    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => "string", 'label' => __('String')],
            ['value' => "counter", 'label' => __('Counter')]];
    }
}
