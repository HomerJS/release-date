<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 */
class Config
{
    CONST XML_PATH_CATALOG_RELEASE_DATE_ENABLE = "catalog/release_date/enable";
    CONST XML_PATH_CATALOG_RELEASE_DATE_MESSAGE_TYPE = "catalog/release_date/message_type";

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CATALOG_RELEASE_DATE_ENABLE);
    }

    /**
     * @return string
     */
    public function getMessageType(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CATALOG_RELEASE_DATE_MESSAGE_TYPE);
    }
}
