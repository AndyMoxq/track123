<?php
namespace Track123\OpenApi\System\Response\OceanCargo;

use Track123\OpenApi\Contracts\Response;

/**
 * Class ChangeOceanCargoCarrierResponse
 * 响应类：变更海运轨迹承运商
 */
class ChangeOceanCargoCarrierResponse extends Response {
    /**
     * 返回字符串结果（Success 或 Fail）
     *
     * @return string
     */
    public function getResult(): string {
        return $this->isSuccess() ? 'Success' : 'Fail';
    }

    /**
     * 判断请求是否成功
     *
     * @return bool
     */
    public function isSuccess(): bool {
        return ($this->getData()['data'] ?? false) == true;
    }

}
