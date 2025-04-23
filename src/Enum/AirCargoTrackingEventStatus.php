<?php

namespace Track123\OpenApi\Enum;

enum AirCargoTrackingEventStatus: string
{
    case BOOKED = 'Consignment booked on a certain flight';
    case RECEIVED = 'Consignment received from shipper or agent';
    case IN_TRANSIT = 'Consignment has been shipped and is on the way to destination';
    case ARRIVED = 'Consignment arrived on a certain flight';
    case NOTIFIED = 'Consignment arrived at destination and the consignee or agent has been';
    case DELIVERED = 'Consignment delivered to Consignee or (if not possible) to customs';
    case EXCEPTION = 'Consignment missing, cargo damaged, or any other exceptions';

    public function label(): string
    {
        return match($this) {
            self::BOOKED => '已订舱',
            self::RECEIVED => '已收货',
            self::IN_TRANSIT => '运输中',
            self::ARRIVED => '航班抵达',
            self::NOTIFIED => '到达通知',
            self::DELIVERED => '已派送/交付海关',
            self::EXCEPTION => '异常',
        };
    }
}
