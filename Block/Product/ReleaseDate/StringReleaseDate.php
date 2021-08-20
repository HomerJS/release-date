<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Block\Product\ReleaseDate;

/**
 * Class StringReleaseDate
 */
class StringReleaseDate extends AbstractReleaseDate
{
    /**
     * @var string
     */
    protected $_template = "Tarknaiev_ReleaseDate::release_date_types/string.phtml";
}
