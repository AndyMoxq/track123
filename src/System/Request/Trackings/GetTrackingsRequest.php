<?php
namespace Track123\OpenApi\System\Request\Trackings;

use Track123\OpenApi\Contracts\Request;

/**
 * 查询轨迹请求类
 * 用于封装对 /tk/v2/track/query 接口的参数构建与验证
 */
class GetTrackingsRequest extends Request {

    public const GET_TRACKINGS_URI = '/tk/v2/track/query';

    /**
     * 构造函数，设置接口 URI
     */
    public function __construct(){
        $this->setApiUri(self::GET_TRACKINGS_URI);
    }

    /**
     * 添加单个 trackingNo
     *
     * @param string $trackNo
     * @return static
     */
    public function setTrackingNo(string $trackNo): static {
        $body = $this->getBody();
        $body['trackNos'][] = $trackNo;
        $this->setBody($body);
        return $this;
    }

    /**
     * 批量添加 trackingNos
     *
     * @param array $trackNos
     * @return static
     */
    public function setTrackingNos(array $trackNos): static {
        foreach ($trackNos as $trackNo) {
            $this->setTrackingNo($trackNo);
        }
        return $this;
    }

    /**
     * 添加单个 orderNo
     *
     * @param string $orderNo
     * @return static
     */
    public function setOrderNo(string $orderNo): static {
        $body = $this->getBody();
        $body['orderNos'][] = $orderNo;
        $this->setBody($body);
        return $this;
    }

    /**
     * 批量添加 orderNos
     *
     * @param array $orderNos
     * @return static
     */
    public function setOrderNos(array $orderNos): static {
        foreach ($orderNos as $orderNo) {
            $this->setOrderNo($orderNo);
        }
        return $this;
    }

    /**
     * 设置创建开始时间
     *
     * @param string $createTimeStart
     * @return static
     */
    public function setCreateTimeStart(string $createTimeStart): static {
        $body = $this->getBody();
        $body['createTimeStart'] = $createTimeStart;
        $this->setBody($body);
        return $this;
    }

    /**
     * 设置创建结束时间
     *
     * @param string $createTimeEnd
     * @return static
     */
    public function setCreateTimeEnd(string $createTimeEnd): static {
        $body = $this->getBody();
        $body['createTimeEnd'] = $createTimeEnd;
        $this->setBody($body);
        return $this;
    }

    /**
     * 设置分页游标
     *
     * @param string $cursor
     * @return static
     */
    public function setCursor(string $cursor): static {
        $body = $this->getBody();
        $body['cursor'] = $cursor;
        $this->setBody($body);
        return $this;
    }

    /**
     * 设置每页条数，最大 100，最小 1
     *
     * @param int $pageSize
     * @return static
     */
    public function setPageSize(int $pageSize = 100): static {
        $pageSize = max(1, min(100, $pageSize));
        $body = $this->getBody();
        $body['queryPageSize'] = $pageSize;
        $this->setBody($body);
        return $this;
    }

    /**
     * 验证日期时间格式是否为 "Y-m-d H:i:s"
     *
     * @param string $dateTime
     * @return bool
     */
    private function validateDateTime(string $dateTime): bool {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        return $dt && $dt->format('Y-m-d H:i:s') === $dateTime;
    }

    /**
     * 执行请求参数校验逻辑
     *
     * @return void
     */
    public function validate(): void {
        $body = $this->getBody();

        if (empty($body)) {
            $this->addError("请求体不能为空");
        }

        if (!empty($body['trackNos']) && count($body['trackNos']) > 100) {
            $this->addError('不能同时查询超过 100 个 trackingNo');
        }

        if (!empty($body['orderNos']) && count($body['orderNos']) > 100) {
            $this->addError('不能同时查询超过 100 个 orderNo');
        }

        if (!empty($body['createTimeStart']) && !$this->validateDateTime($body['createTimeStart'])) {
            $this->addError("createTimeStart 格式错误，必须是 Y-m-d H:i:s");
        }

        if (!empty($body['createTimeEnd']) && !$this->validateDateTime($body['createTimeEnd'])) {
            $this->addError("createTimeEnd 格式错误，必须是 Y-m-d H:i:s");
        }

        $this->throwErrors();
    }
}