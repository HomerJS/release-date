<?php
declare(strict_types=1);

namespace Tarknaiev\ReleaseDate\Block\Product\ReleaseDate;

/**
 * @package Tarknaiev\ReleaseDate\Block\Product\ReleaseDate
 */
class CounterReleaseDate extends AbstractReleaseDate
{
    /**
     * @var string
     */
    protected $_template = "Tarknaiev_ReleaseDate::release_date_types/counter.phtml";
}
