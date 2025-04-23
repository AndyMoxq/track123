<?php
namespace Track123\OpenApi\System\Response\OceanCargo;

use Track123\OpenApi\Contracts\Response;

class GetOceanCargoTrackingsResponse extends Response {

  /**
   * 获取所有被拒绝数据的错误信息字符串（用于打印或日志）
   *
   * @return string
   */
  public function getRejectedMessages(): string {
    $message = '';
    foreach ($this->getRejectedData() as $rejected) {
        $message .= 'trackingNo: ' . $rejected['trackingNo'] .
                    ' orderNo: ' . $rejected['orderNo'] .
                    ' msg: ' . ($rejected['error']['msg'] ?? 'Unknown Error') . "\n";
    }
    return $message;
}
}
