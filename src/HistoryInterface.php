<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace LinkSoft\Source;

interface HistoryInterface
{
    /**
     * 分时线
     * @param string $instrument 证券标识
     * @param string $period 区间 day|5day
     * @return array
     */
    public function timeLine(string $instrument, string $period): array;

    /**
     * K线
     * @param string $instrument
     * @param string $period 区间 1d|5d|week|month|year|1min|5min|15min|30min|60min
     * @param int $right 0:不复权 1:前复权 2:后复权
     * @return array
     */
    public function kLine(string $instrument, string $period, int $right): array;
}
