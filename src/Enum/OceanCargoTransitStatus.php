<?php
namespace Track123\OpenApi\Enum;
/**
 * 单个货物运输状态（集装箱/票）
 */
enum OceanCargoTransitStatus: string
{
    case NO_RECORD = 'The cargo has no tracking information available yet.';
    case IN_TRANSIT = 'The cargo is in transit';
    case DELIVERED = 'Cargo delivered successfully.';
    case EXPIRED = 'The cargo has no tracking information for 30 days since added.';

    public function label(): string
    {
        return match($this) {
            OceanCargoTransitStatus::NO_RECORD => '暂无轨迹',
            OceanCargoTransitStatus::IN_TRANSIT => '运输中',
            OceanCargoTransitStatus::DELIVERED => '已送达',
            OceanCargoTransitStatus::EXPIRED => '已过期',
        };
    }
}