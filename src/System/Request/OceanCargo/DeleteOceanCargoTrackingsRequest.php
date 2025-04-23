<?php
namespace Track123\OpenApi\System\Request\OceanCargo;

use Track123\OpenApi\Contracts\Request;

/**
 * Class DeleteOceanCargoTrackingsRequest
 * 删除海运轨迹信息（支持批量删除）
 */
class DeleteOceanCargoTrackingsRequest extends Request
{
    /**
     * 接口路径
     */
    public const URI = '/tk/v1/ocean/track/delete';

    /**
     * 设置 API URI
     */
    public function __construct()
    {
        $this->setApiUri(self::URI);
    }

    /**
     * 添加一条删除请求
     *
     * @param string $orderNo 订单号
     * @param string $trackingNo 运单号
     * @param int $type 类型（1=booking, 2=bill, 3=container）
     * @return static
     */
    public function deleteTracking(string $orderNo, string $trackingNo, int $type = 2): static
    {
        $body = $this->getBody();
        $body[] = [
            'orderNo' => $orderNo,
            'trackingNo' => $trackingNo,
            'type' => $type
        ];
        $this->setBody($body);
        return $this;
    }

    /**
     * 设置多条删除请求
     *
     * @param array $trackings 删除项数组，每项包含 orderNo、trackingNo、type
     * @return static
     */
    public function deleteTrackings(array $trackings): static
    {
        $body = array_merge($this->getBody(), $trackings);
        $this->setBody($body);
        return $this;
    }

    /**
     * 请求数据验证
     *
     * @return void
     */
    public function validate(): void
    {
        $body = $this->getBody();
        if (empty($body)) {
            $this->addError("Request body can not be empty. At least one tracking");
        }

        foreach ($body as $index => $tracking) {
            if (empty($tracking['orderNo'])) {
                $this->addError("Index:{$index}, orderNo can not be empty");
            }
            if (empty($tracking['trackingNo'])) {
                $this->addError("Index:{$index}, trackingNo can not be empty");
            }

            if (!isset($tracking['type']) || !in_array($tracking['type'], [1, 2, 3], true)) {
                $this->addError("Index:{$index}, type must be an integer and in [1=booking number, 2=bill of lading number, 3=container number]");
            }
        }
    }
}
