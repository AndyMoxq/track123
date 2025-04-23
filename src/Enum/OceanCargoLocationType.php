<?php
namespace Track123\OpenApi\Enum;
/**
 * 地点类型标识
 */
enum OceanCargoLocationType: string
{
    case PRE = 'Place of receipt';
    case POL = 'Port of loading';
    case POT = 'Port of transfer';
    case POD = 'Port of discharge';
    case PDE = 'Place of delivery';

    public function label(): string
    {
        return match($this) {
            OceanCargoLocationType::PRE => '起运地',
            OceanCargoLocationType::POL => '装货港',
            OceanCargoLocationType::POT => '中转港',
            OceanCargoLocationType::POD => '卸货港',
            OceanCargoLocationType::PDE => '目的地',
        };
    }
}
