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

interface BasicInterface
{
    /**
     * @param string $instrument 证券标识
     * @param string $keyword 关键词
     * @param string $lang 语言 zh-CN|en
     * @return array
     */
    public function search(string $instrument, string $keyword, string $lang): array;

    /**
     * @param string $market 市场
     * @param string $securityType 证券类型
     * @param string $lang 语言 zh-CN|en
     * @return array
     */
    public function openTime(string $market, string $securityType, string $lang): array;

    /**
     * 实时汇率.
     * @param string $from 起始币种 CNY|USD|HKD|SGD|AUD|JPY|EUR|GBP|KER|CAD|DZD|ARS|IEP|EGP|AED
     * @param string $to 目标币种 CNY|USD|HKD|SGD|AUD|JPY|EUR|GBP|KER|CAD|DZD|ARS|IEP|EGP|AED
     * @return array
     */
    public function moneyRate(string $from, string $to): array;

    /**
     * 基础对照表.
     * @param string $instrument 证券标识
     * @return array
     */
    public function basicInfo(string $instrument): array;

    /**
     * 涨跌分布.
     * @param string $market 证券市场
     * @param string $securityType 证券类型
     * @return array
     */
    public function gainDistribute(string $market, string $securityType): array;

    /**
     * 榜单排行.
     * @param string $market 证券市场
     * @param string $securityType 证券类型
     * @param int $limit 数量
     * @param int $offset 开始位置
     * @param string $field 字段
     * @param string $order 排序
     * @param string $lang 语言
     * @return array
     */
    public function rank(string $market, string $securityType, int $limit, int $offset, string $field, string $order, string $lang): array;

    /**
     * 板块列表.
     * @param int $plateType 板块类型 1:行业板块 2:概念板块
     * @param string $market 交易市场 多个,分隔
     * @param string $securityType 证券类型
     * @param string $order 排序
     * @param int $pageSize 每页数量
     * @param string $lang 语言
     * @return array
     */
    public function plateList(int $plateType, string $market, string $securityType, string $order, int $pageSize, string $lang): array;

    /**
     * 板块详情.
     * @param string $market 交易市场 多个,分隔
     * @param string $securityType 证券类型
     * @param string $plateId 板块Id
     * @param int $plateType 板块类型 1:行业板块 2:概念板块
     * @param string $field 字段
     * @param string $order 排序
     * @param int $page 页数
     * @param int $pageSize 每页数量
     * @param string $lang 语言
     * @return array
     */
    public function plateInfo(string $market, string $securityType, string $plateId, int $plateType, string $field, string $order, int $page, int $pageSize, string $lang): array;

    /**
     * 市场板块.
     * @param string $market 交易市场
     * @param string $securityType 证券类型
     * @param string $plateName 板块名称 US_STAR：明星股 US_CHINA：中概股 SSE_PLATE：沪股通 SZSE_PLATE：深股通 CREATE_PLATE：创业板 MAIN_PLATE：主板
     * @param string $order 排序
     * @param int $page 页数
     * @param int $pageSize 每页数量
     * @param string $field 字段
     * @param string $lang 语言
     * @return array
     */
    public function marketPlate(string $market, string $securityType, string $plateName, string $order, int $page, int $pageSize, string $field, string $lang): array;
}
