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

interface OtherInterface
{
    /**
     * @param string $type 行情卡市场
     * @param string $countryCode 国家编码
     * @param string $mobile 手机号码
     * @param float $amount 人民币
     * @param string $realName 真实姓名
     * @param string $email 邮箱
     * @param string $target 投资目标
     * @param int $level 行情等级
     * @param string $platform 使用平台
     * @param string $startDate 开始日期
     * @param string $endDate 结束日期
     * @return array
     */
    public function createCard(string $type, string $countryCode, string $mobile, float $amount, string $realName, string $email, string $target, int $level, string $platform, string $startDate, string $endDate): array;
}
