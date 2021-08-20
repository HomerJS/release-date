<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Helper;

use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Class Time
 */
class Time
{
    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $timezone;

    /**
     * Time constructor.
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        TimezoneInterface $timezone
    ) {
        $this->timezone = $timezone;
    }

    /**
     * @param string $releaseDateTime
     * @return bool
     */
    public function hasLeftTime(string $releaseDateTime): bool
    {
        $currentDate = $this->timezone->date();
        $releaseDate =  $this->timezone->date($releaseDateTime);
        return $releaseDate > $currentDate;
    }

    /**
     * @param string $date
     * @return string
     */
    public function prepareCurrentDate(string $date): string
    {
        return $this->timezone->date($date)->format("Y-m-d H:i:s");
    }
}
