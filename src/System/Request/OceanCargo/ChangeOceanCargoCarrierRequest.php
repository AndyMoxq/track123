<?php
namespace Track123\OpenApi\System\Request\OceanCargo;
use Track123\OpenApi\Contracts\Request;

/**
 * Class ChangeOceanCargoCarrierRequest
 * 更改承运列表
 */
class ChangeOceanCargoCarrierRequest extends Request
{
    /**
     * 接口路径
     */
    public const URI = '/tk/v1/ocean/track/update-carrier';

    /**
     * 设置 API URI
     */
    public function __construct(){
        $this->setApiUri(self::URI);
    }

    /**
     * 设置承运商编码
     *
     * @param string $carrierCode
     * @return static
     */
    public function setCarrierCode(string $carrierCode): static
    {
        $body = $this->getBody();
        $body['carrierCode'] = $carrierCode;
        $this->setBody($body);
        return $this;
    }

    /**
     * 添加一条明细数据
     *
     * @param string $orderNo
     * @param string $trackingNo
     * @param int $type 类型（1-booking, 2-bill, 3-container）
     * @return static
     */
    public function setDetail(string $orderNo, string $trackingNo, int $type = 2): static
    {
        $body = $this->getBody();
        $body['details'][] = [
            'orderNo' => $orderNo,
            'trackingNo' => $trackingNo,
            'type' => $type
        ];
        $this->setBody($body);
        return $this;
    }

    /**
     * 设置多条明细数据
     *
     * @param array $details
     * @return static
     */
    public function setDetails(array $details): static
    {
        $body = $this->getBody();
        foreach ($details as $detail) {
            $body['details'][] = $detail;
        }
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
        if (empty($body['carrierCode'])) {
            $this->addError('carrierCode can not be empty');
        }

        if (empty($body['details'])) {
            $this->addError('details can not be empty, expect to be an array of object');
        }

        foreach ($body['details'] ?? [] as $index => $detail) {
            if (empty($detail['orderNo'])) {
                $this->addError("Index:{$index}, orderNo can not be null");
            }
            if (empty($detail['trackingNo'])) {
                $this->addError("Index:{$index}, trackingNo can not be null");
            }

            if (!isset($detail['type']) || !in_array($detail['type'], [1, 2, 3], true)) {
                $this->addError("Index:{$index}, type must be an integer and in [1=booking number, 2=bill of lading number, 3=container number]");
            }
        }
        $this -> throwErrors();
    }
}