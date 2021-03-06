<?phpnamespace LinkSoft\Source;class SourceData implements QuoteInterface, BasicInterface, HistoryInterface, OtherInterface, F10Interface{    /**     * @var SourceRequest     */    private $client;    public function __construct(SourceRequest $request)    {        $this->client = $request;    }    /**     * @param string $instrument 证券标识     * @param string $keyword 关键词     * @param string $lang 语言 zh-CN|en     * @return array     */    public function search(string $instrument, string $keyword, string $lang): array    {        // TODO: Implement search() method.        $response = $this->client->request('POST', 'Api/V1/Basic/Search', ['instrument' => $instrument, 'keyword' => $keyword, 'lang' => $lang]);        return $response->getResult();    }    /**     * @param string $market 市场     * @param string $securityType 证券类型     * @param string $lang 语言 zh-CN|en     * @return array     */    public function openTime(string $market, string $securityType, string $lang): array    {        // TODO: Implement openTime() method.        $response = $this->client->request('POST', 'Api/V1/Basic/OpenTime', [            'market' => $market,            'securityType' => $securityType,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 实时汇率.     * @param string $from 起始币种 CNY|USD|HKD|SGD|AUD|JPY|EUR|GBP|KER|CAD|DZD|ARS|IEP|EGP|AED     * @param string $to 目标币种 CNY|USD|HKD|SGD|AUD|JPY|EUR|GBP|KER|CAD|DZD|ARS|IEP|EGP|AED     * @return array     */    public function moneyRate(string $from, string $to): array    {        // TODO: Implement moneyRate() method.        if ($from == $to) return ['code' => 1, 'msg' => 'ok', 'data' => ['from' => $from, 'to' => $to, 'rate' => 1]];        $response = $this->client->request('POST', 'Api/V1/Basic/MoneyRate', [            'from' => $from,            'to' => $to,        ]);        return $response->getResult();    }    /**     * 基础对照表.     * @param string $instrument 证券标识     * @param int $page     * @param int $pageSize     * @return array     */    public function basicInfo(string $instrument, int $page = 1, int $pageSize = 100): array    {        // TODO: Implement basicInfo() method.        $response = $this->client->request('POST', 'Api/V1/Basic/BasicInfo', [            'instrument' => $instrument,            'page' => $page,            'pageSize' => $pageSize,        ]);        return $response->getResult();    }    /**     * 涨跌分布.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @return array     */    public function gainDistribute(string $market, string $securityType): array    {        // TODO: Implement gainDistribute() method.        $response = $this->client->request('POST', 'Api/V1/Link/GainDistribution', [            'market' => $market,            'securityType' => $securityType,        ]);        return $response->getResult();    }    /**     * 榜单排行.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @param int $limit 数量     * @param int $offset 开始位置     * @param string $field 字段     * @param string $order 排序     * @param string $lang 语言     * @return array     */    public function rank(string $market, string $securityType, int $limit, int $offset, string $field, string $order, string $lang): array    {        // TODO: Implement rank() method.        $response = $this->client->request('POST', 'Api/V1/Link/Rank', [            'market' => $market,            'securityType' => $securityType,            'limit' => $limit,            'offset' => $offset,            'field' => $field,            'order' => $order,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 板块列表.     * @param int $plateType 板块类型 1:行业板块 2:概念板块     * @param string $market 交易市场 多个,分隔     * @param string $securityType 证券类型     * @param string $order 排序     * @param int $pageSize 每页数量     * @param string $lang 语言     * @return array     */    public function plateList(int $plateType, string $market, string $securityType, string $order, int $pageSize, string $lang): array    {        // TODO: Implement plateList() method.        $response = $this->client->request('POST', 'Api/V1/Link/PlateList', [            'plateType' => $plateType,            'market' => $market,            'securityType' => $securityType,            'order' => $order,            'pageSize' => $pageSize,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 板块详情.     * @param string $market 交易市场 多个,分隔     * @param string $securityType 证券类型     * @param string $plateId 板块Id     * @param int $plateType 板块类型 1:行业板块 2:概念板块     * @param string $field 字段     * @param string $order 排序     * @param int $page 页数     * @param int $pageSize 每页数量     * @param string $lang 语言     * @return array     */    public function plateInfo(string $market, string $securityType, string $plateId, int $plateType, string $field, string $order, int $page, int $pageSize, string $lang): array    {        // TODO: Implement plateInfo() method.        $response = $this->client->request('POST', 'Api/V1/Link/PlateInfo', [            'market' => $market,            'securityType' => $securityType,            'plateId' => $plateId,            'plateType' => $plateType,            'field' => $field,            'order' => $order,            'page' => $page,            'pageSize' => $pageSize,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 市场板块.     * @param string $market 交易市场     * @param string $securityType 证券类型     * @param string $plateName 板块名称 US_STAR：明星股 US_CHINA：中概股 SSE_PLATE：沪股通 SZSE_PLATE：深股通 CREATE_PLATE：创业板 MAIN_PLATE：主板     * @param string $order 排序     * @param int $page 页数     * @param int $pageSize 每页数量     * @param string $field 字段     * @param string $lang 语言     * @return array     */    public function marketPlate(string $market, string $securityType, string $plateName, string $order, int $page, int $pageSize, string $field, string $lang): array    {        // TODO: Implement marketPlate() method.        $response = $this->client->request('POST', 'Api/V1/Link/MarketPlate', [            'market' => $market,            'securityType' => $securityType,            'plateName' => $plateName,            'order' => $order,            'page' => $page,            'pageSize' => $pageSize,            'field' => $field,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 分时线     * @param string $instrument 证券标识     * @param string $period 区间 day|5day     * @param string $lang     * @return array     */    public function timeLine(string $instrument, string $period, string $lang = 'zh-CN'): array    {        // TODO: Implement timeLine() method.        $response = $this->client->request('POST', 'Api/V1/History/TimeLine', [            'instrument' => $instrument,            'period' => $period,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * K线     * @param string $instrument     * @param string $period 区间 1d|5d|week|month|year|1min|5min|15min|30min|60min     * @param int $right 0:不复权 1:前复权 2:后复权     * @param string $lang     * @return array     */    public function kLine(string $instrument, string $period, int $right, string $lang = 'zh-CN'): array    {        // TODO: Implement kLine() method.        $response = $this->client->request('POST', 'Api/V1/History/KLine', [            'instrument' => $instrument,            'period' => $period,            'right' => $right,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * @param string $type 行情卡市场     * @param string $countryCode 国家编码     * @param string $mobile 手机号码     * @param float $amount 人民币     * @param string $realName 真实姓名     * @param string $email 邮箱     * @param string $target 投资目标     * @param int $level 行情等级     * @param string $platform 使用平台     * @param string $startDate 开始日期     * @param string $endDate 结束日期     * @return array     */    public function createCard(string $type, string $countryCode, string $mobile, float $amount, string $realName, string $email, string $target, int $level, string $platform, string $startDate, string $endDate): array    {        // TODO: Implement createCard() method.        $response = $this->client->request('POST', 'Api/V1/QuotationCard/CreateCard', [            'type' => $type,            'countryCode' => $countryCode,            'mobile' => $mobile,            'money' => $amount,            'realName' => $realName,            'email' => $email,            'target' => $target,            'level' => $level,            'platform' => $platform,            'startDate' => $startDate,            'endDate' => $endDate,        ]);        return $response->getResult();    }    /**     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @return array     */    public function detail(string $instrument, string $lang): array    {        // TODO: Implement detail() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/Detail', [            'instrument' => $instrument,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 获取行情接口     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @return array     */    public function detailV2(string $instrument, string $lang): array    {        // TODO: Implement detailV2() method.        $response = $this->client->request('POST', 'Api/V2/Quotation/Detail', [            'instrument' => $instrument,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 批量获取行情     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @param int $format 格式     * @return array     */    public function batchDetail(string $instrument, string $lang, int $format): array    {        // TODO: Implement batchDetail() method.        return $this->_batchDetail($instrument, $lang, $format, sha1(serialize(func_get_args())));    }    /**     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @param int $format 格式     * @param string $cacheKey     * @return array     */    private function _batchDetail(string $instrument, string $lang, int $format, string $cacheKey): array    {        // TODO: Implement batchDetail() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/BatchDetail', [            'instrument' => $instrument,            'format' => $format,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 批量获取行情V2     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @param int $format 格式     * @return array     */    public function batchDetailV2(string $instrument, string $lang, int $format): array    {        // TODO: Implement batchDetailV2() method.        return $this->_batchDetailV2($instrument, $lang, $format, sha1(serialize(func_get_args())));    }    /**     * @param string $instrument 证券标识     * @param string $lang 语言 zh-CN|en     * @param int $format 格式     * @param string $cacheKey     * @return array     */    private function _batchDetailV2(string $instrument, string $lang, int $format, string $cacheKey): array    {        // TODO: Implement batchDetailV2() method.        $response = $this->client->request('POST', 'Api/V2/Quotation/BatchDetail', ['instrument' => $instrument, 'format' => $format, 'lang' => $lang]);        return $response->getResult();    }    /**     * 获取逐笔交易     * @param string $instrument 证券标识     * @param int $offset 起始点     * @param int $limit 限制数量     * @return array     */    public function tick(string $instrument, int $offset, int $limit): array    {        // TODO: Implement tick() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/Tick', [            'instrument' => $instrument,            'offset' => $offset,            'limit' => $limit,        ]);        return $response->getResult();    }    /**     * 深度报价.     * @param string $instrument 证券标识     * @param int $depth 深度     * @return array     */    public function depthQuota(string $instrument, int $depth): array    {        // TODO: Implement depthQuota() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/DepthQuoteL2', [            'instrument' => $instrument,            'depth' => $depth,        ]);        return $response->getResult();    }    /**     * 资金流向.     * @return array     */    public function amtFlow(): array    {        // TODO: Implement amtFlow() method.        $response = $this->client->request('POST', 'Api/V2/Quotation/AmtFlow', []);        return $response->getResult();    }    /**     * 资金流向K线     * @param int $type 1:北向概况 2:南向概况     * @return array     */    public function amtFlowKline($type): array    {        // TODO: Implement amtFlowKline() method.        $response = $this->client->request('POST', 'Api/V2/Quotation/AmtFlowKline', [            'type' => $type,        ]);        return $response->getResult();    }    /**     * 指定股票经纪商列表     * @param string $instrument 证券标识     * @param string $lang 语言     * @return array     */    public function broker(string $instrument, string $lang): array    {        // TODO: Implement broker() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/Broker', [            'instrument' => $instrument,            'lang' => $lang,        ]);        return $response->getResult();    }    /**     * 券商列表.     * @return array     */    public function brokers(): array    {        // TODO: Implement brokers() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/Brokers', []);        return $response->getResult();    }    /**     * 获取论证数据     * @param string $securityTypes 证券标识     * @param string $symbol 标的股票     * @param string $field 排序字段     * @param string $order 排序类型     * @param int $page 页码     * @param int $pageSize 每页条数     * @return array     */    public function turbineSearch(string $securityTypes, string $symbol, string $field, string $order, int $page, int $pageSize): array    {        // TODO: Implement turbineSearch() method.        $response = $this->client->request('POST', 'Api/V1/Basic/turbineSearch', [            'securityTypes' => explode(',', $securityTypes),            'underlyingSymbol' => $symbol,            'orderKeyword' => $field,            'orderType' => $order,            'page' => $page,            'pageSize' => $pageSize,        ]);        return $response->getResult();    }    /**     * 发送原始请求     * @param $method     * @param $route     * @param $options     * @return array     */    public function searchRaw($method, $route, $options)    {        $response = $this->client->request($method, $route, $options);        return $response->getResult();    }    /**     * 公司公告.     * @param string $market 证券市场     * @param string $symbol 股票代码     * @param int $page 页数     * @param int $pageSize 每页数量     * @return array     */    public function notice(string $market, string $symbol, int $page, int $pageSize): array    {        // TODO: Implement notice() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetNotice', [            'market' => $market,            'symbol' => $symbol,            'page' => $page,            'pageSize' => $pageSize,        ]);        return $response->getResult();    }    /**     * 公司新闻.     * @param string $market 证券市场     * @param string $symbol 股票代码     * @param int $page 页数     * @param int $pageSize 每页数量     * @return array     */    public function news(string $market, string $symbol, int $page, int $pageSize): array    {        // TODO: Implement news() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetNews', [            'market' => $market,            'symbol' => $symbol,            'page' => $page,            'pageSize' => $pageSize,        ]);        return $response->getResult();    }    /**     * 公司新闻详情.     * @param string $id id     * @return array     */    public function newsInfo(string $id)    {        // TODO: Implement newsInfo() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetNewsInfo', [            'id' => $id,        ]);        return $response->getResult();    }    /**     * 公司简况.     * @param string $market 证券市场     * @param string $symbol 股票代码     * @param string $securityType 证券类型     * @return array     */    public function company(string $market, string $securityType, string $symbol): array    {        // TODO: Implement company() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetCompany', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,        ]);        return $response->getResult();    }    /**     * 分红派息.     * @param string $market 证券市场     * @param string $symbol 股票代码     * @param string $securityType 证券类型     * @param string $startDate 开始时间     * @param string $endDate 结束时间     * @return array     */    public function dividend(string $market, string $securityType, string $symbol, string $startDate, string $endDate): array    {        // TODO: Implement dividend() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetDividend', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,            'startDate' => $startDate,            'endDate' => $endDate,        ]);        return $response->getResult();    }    /**     * 利润表.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @param string $symbol 股票代码     * @param string $startDate 开始时间     * @param string $endDate 结束时间     * @param string $period 1：1季报 2：2季度 3：3季报 4：年报 仅美股（5：2季报累计 6：3季报累计） 不传即所有     * @return array     */    public function profit(string $market, string $securityType, string $symbol, string $startDate, string $endDate, string $period): array    {        // TODO: Implement profit() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetProfit', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,            'startDate' => $startDate,            'endDate' => $endDate,            'period' => $period,        ]);        return $response->getResult();    }    /**     * 现金流量表.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @param string $symbol 股票代码     * @param string $startDate 开始时间     * @param string $endDate 结束时间     * @param string $period 1：1季报 2：2季度 3：3季报 4：年报 仅美股（5：2季报累计 6：3季报累计） 不传即所有     * @return array     */    public function flow(string $market, string $securityType, string $symbol, string $startDate, string $endDate, string $period): array    {        // TODO: Implement flow() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetFlow', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,            'startDate' => $startDate,            'endDate' => $endDate,            'period' => $period,        ]);        return $response->getResult();    }    /**     * 资产负债表.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @param string $symbol 股票代码     * @param string $startDate 开始时间     * @param string $endDate 结束时间     * @param string $period 1：1季报 2：2季度 3：3季报 4：年报 仅美股（5：2季报累计 6：3季报累计） 不传即所有     * @return array     */    public function asset(string $market, string $securityType, string $symbol, string $startDate, string $endDate, string $period): array    {        // TODO: Implement asset() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetAsset', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,            'startDate' => $startDate,            'endDate' => $endDate,            'period' => $period,        ]);        return $response->getResult();    }    /**     * 拆股合股     * @param string $market 证券市场     * @param mixed $securityType     * @param mixed $symbol     * @param mixed $startDate     * @param mixed $endDate     * @return array     */    public function splits(string $market, string $securityType, string $symbol, string $startDate, string $endDate): array    {        // TODO: Implement splits() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetSplits', [            'market' => $market,            'symbol' => $symbol,            'securityType' => $securityType,            'startDate' => $startDate,            'endDate' => $endDate,        ]);        return $response->getResult();    }    /**     * 分红派息 - 指定日期     * @param string $market 证券市场     * @param string $searchDate 查询日期     * @return array     */    public function appointDividend(string $market, string $searchDate): array    {        // TODO: Implement appointDividend() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetAppointDividend', [            'market' => $market,            'searchDate' => $searchDate,        ]);        return $response->getResult();    }    /**     * 拆股合股 - 指定日期     * @param string $market 证券市场     * @param string $searchDate 查询日期     * @return array     */    public function appointSplits(string $market, string $searchDate): array    {        // TODO: Implement appointSplits() method.        $response = $this->client->request('POST', 'Api/V2/F10/GetSplitShares', [            'market' => $market,            'searchDate' => $searchDate,        ]);        return $response->getResult();    }    /**     * 股票变更 - 指定日期     * @param string $market 证券市场     * @param string $searchDate 查询日期     * @return array     */    public function appointChange(string $market, string $searchDate): array    {        // TODO: Implement appointChange() method.        $response = $this->client->request('POST', 'Api/V1/F10/GetAppointChange', [            'market' => $market,            'searchDate' => $searchDate,        ]);        return $response->getResult();    }    /**     * 分布及流向.     * @param string $market 证券市场     * @param string $securityType 证券类型     * @param string $symbol 股票代码     * @return array     */    public function distAndFlow(string $market, string $securityType, string $symbol): array    {        // TODO: Implement distAndFlow() method.        $response = $this->client->request('POST', 'Api/V1/Quotation/GetDistAndFlow', [            'market' => $market,            'securityType' => $securityType,            'symbol' => $symbol,        ]);        return $response->getResult();    }    /**     * 证券新闻.     * @param string $type     * @param string $market 证券市场     * @param string $instrument     * @param string $startDate     * @param string $endDate     * @param bool $isShowContent     * @param string $channel     * @param int $page 页数     * @param int $pageSize 每页数量     * @return array     */    public function newsV2(string $type, string $market, string $instrument, string $startDate, string $endDate, bool $isShowContent, string $channel, int $page, int $pageSize): array    {        // TODO: Implement newsV2() method.        $response = $this->client->request('POST', 'Api/V2/F10/GetNews', [            'type' => $type,            'market' => $market,            'instrument' => $instrument,            'startDate' => $startDate,            'endDate' => $endDate,            'isShowContent' => $isShowContent,            'page' => $page,            'pageSize' => $pageSize,            'channel' => $channel,        ]);        return $response->getResult();    }}