<?php
namespace Track123\OpenApi\System\Response\Trackings;


use Track123\OpenApi\Contracts\Response;
use Track123\OpenApi\Exception\ValidateResponseException;

class registerTrackingResponse extends Response
{
  
    public function accepted(): bool{
      return !empty($this -> getData()['accepted']);
    }

    public function rejected(): bool{
      return !empty($this -> getData()['rejected']);
    }
    
    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        parent::validate();
        if($this -> rejected()){
          $rejected = $this -> getBody()['rejected']??[];
          foreach ($rejected as $value) {
            $msg = "TrackingNo:" . $value['trackNo'] . ' error code:' . $value['error']['code'] . ' msg:' . $value['error']['msg'];
          }
          throw new ValidateResponseException($msg, 1);
        }
    }
}
