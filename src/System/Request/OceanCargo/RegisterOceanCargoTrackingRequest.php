<?php
namespace Track123\OpenApi\System\Request\OceanCargo;
use Track123\OpenApi\Contracts\Request;

/**
 * Class RegisterOceanCargoTrackingRequest
 * 海运轨迹注册请求类
 */
class RegisterOceanCargoTrackingRequest extends Request
{
    /**
     * 接口路径
     */
    public const URI = '/tk/v1/ocean/track/import';

    /**
     * 构造函数，设置 API URI
     */
    public function __construct()
    {
        $this->setApiUri(self::URI);
    }

    /**
     * 添加一条轨迹信息（追加到 body 中）
     *
     * @param array $tracking 单条轨迹信息
     * @return static
     */
    public function setTracking(array $tracking): static
    {
        $body = $this->getBody();
        $body[] = $tracking;
        $this->setBody($body);
        return $this;
    }

    /**
     * 使用独立参数构建一条轨迹并添加
     *
     * @param string $trackingNo 运单号
     * @param string $carrierCode 承运商代码
     * @param int $type 编号类型：1-booking, 2-bill, 3-container
     * @param string|null $customerEmail 客户邮箱
     * @return static
     */
    public function addTracking(string $trackingNo, string $carrierCode, int $type = 2, string $customerEmail = null): static
    {
        $tracking = [
            'trackingNo' => $trackingNo,
            'carrierCode' => $carrierCode,
            'type' => $type,
            'customerEmail' => $customerEmail
        ];
        $this->setTracking($tracking);
        return $this;
    }

    /**
     * 批量设置多条轨迹信息（合并到 body 中）
     *
     * @param array $trackings 多条轨迹数组
     * @return static
     */
    public function setTrackings(array $trackings): static
    {
        $body = $this->getBody();
        $body = array_merge($body, $trackings);
        $this->setBody($body);
        return $this;
    }

    /**
     * 请求参数验证逻辑
     *
     * @return void
     */
    public function validate(): void
    {
        $trackings = $this->getBody();
        if (empty($trackings)) {
            $this->addError('海运运单信息不能为空');
        }
        foreach ($trackings as $index => $tracking) {
            if (empty($tracking['trackingNo'])) {
                $this->addError("第{$index}个trackingNo必填");
            }

            if (empty($tracking['carrierCode'])) {
                $this->addError("第{$index}个carrierCode必填");
            }

            if (!isset($tracking['type']) || !in_array($tracking['type'], [1, 2, 3], true)) {
                $this->addError("第{$index}个type必填,并且为数字：1. booking number 2. bill of landing number 3. container number");
            }
        }
        $this->throwErrors();
    }
}