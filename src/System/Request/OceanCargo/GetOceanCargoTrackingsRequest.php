<?php
namespace Track123\OpenApi\System\Request\OceanCargo;
use Track123\OpenApi\Contracts\Request;

/**
 * Class ChangeOceanCargoCarrierRequest
 * 更改承运列表
 */
class GetOceanCargoTrackingsRequest extends Request
{
    /**
     * 接口路径
     */
    public const URI = '/tk/v1/ocean/track/query';

    /**
     * 设置 API URI
     */
    public function __construct(){
        $this->setApiUri(self::URI);
    }

    public function setTracking(string $orderNo,string $trackingNo,int $type=2){
      $body = $this -> getBody();
      $body[]=[
        'orderNo' => $orderNo,
        'trackingNo' => $trackingNo,
        'type' => $type
      ];
      $this -> setBody($body);
      return $this;
    }

    public function setTrackings(array $trackings){
      $body = $this -> getBody();
      foreach ($trackings as $tracking) {
        $body[] = $tracking;
      }
      $this -> setBody($body);
      return $this;
    }

    public function validate(){
      $body = $this -> getBody();
      if(empty($body)){
        $this -> addError("Request body can not be empty.At least one tracking");
      }

      foreach ($body as $index => $tracking) {
        if(empty($tracking['orderNo'])){
          $this -> addError("Index:{$index},orderNo can not be empty");
        }
        if(empty($tracking['trackingNo'])){
          $this -> addError("Index:{$index},trackingNo can not be empty");
        }

        if (!isset($tracking['type']) || !in_array($tracking['type'], [1, 2, 3], true)) {
            $this->addError("Index:{$index}, type must be an integer and in [1=booking number, 2=bill of lading number, 3=container number]");
        }
      }
      $this -> throwErrors();
    }
  }