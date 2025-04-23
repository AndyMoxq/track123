<?php
namespace Track123\OpenApi\Enum;
/**
 * 新增货物追踪搜索状态（整票层级）
 */
enum OceanCargoSearchStatus: string
{
    case INIT = 'New shipments added that are pending to track.';
    case IN_TRANSIT = 'The shipment is in transit';
    case FINAL = 'All cargos of the shipment delivered successfully.';
    case NO_RECORD = 'The shipment has no tracking information available yet.';
    case EXPIRED = 'The shipment has no tracking information for 30 days since added.';

    public function label(): string
    {
        return match($this) {
            OceanCargoSearchStatus::INIT => '待追踪',
            OceanCargoSearchStatus::IN_TRANSIT => '运输中',
            OceanCargoSearchStatus::FINAL => '已完成',
            OceanCargoSearchStatus::NO_RECORD => '暂无轨迹',
            OceanCargoSearchStatus::EXPIRED => '已过期',
        };
    }
}