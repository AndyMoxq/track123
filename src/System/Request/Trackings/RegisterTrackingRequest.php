<?php
namespace Track123\OpenApi\System\Request\Trackings;

use Track123\OpenApi\Contracts\Request;
use Track123\OpenApi\Exception\ValidateRequestException;

class RegisterTrackingRequest extends Request
{
    public const URI = '/tk/v2/track/import';

    public function __construct()
    {
        $this->setApiUri(self::URI);
    }

    public function addTracking(array $tracking): static
    {
        $body = $this->getBody();
        $body[] = $tracking;
        $this->setBody($body);
        return $this;
    }

    public function addTrackings(array $trackings): static
    {
        foreach ($trackings as $tracking) {
            $this->addTracking($tracking);
        }
        return $this;
    }

    public function validate()
    {
        if(empty($this -> getBody())){
            $this -> addError('trackings 不能为空');
        }
        foreach ($this -> getBody() as $index => $tracking) {
            if(empty($tracking['trackNo'])) $this -> addError('Trackings第'.$index + 1 . "行，trackNo 不能为空");
        }
        $this -> throwErrors();
    }
}