<?php
namespace Track123\OpenApi\Enum;
/**
 * 追踪事件状态码
 */
enum OceanCargoEventStatus: string
{
    case STUF = 'Stuffed, the container has been loaded with cargo.';
    case STRP = 'Stripped, the container has been unloaded and is now empty.';
    case LOAD = 'Loaded, the container has been loaded onto a vessel, truck, or train.';
    case DISC = 'Discharged, the container has been unloaded from a vessel, truck, or train.';
    case GTOT = 'Gate out, the container has exited the terminal or yard through the gate.';
    case GTIN = 'Gate in, the container has entered the terminal or yard through the gate.';
    case DEPA = 'Departed, the transportation carrying the container has departed from the port or terminal.';
    case ARRI = 'Arrived, the transportation carrying the container has arrived at the port or terminal.';
    case BERT = 'Berthed, the vessel has docked at the terminal.';
    case HOLD = 'Container on hold, the container is on hold, possibly due to inspection, documentation issues, or unpaid fees.';
    case CUST = 'Customs released, the container has cleared customs and is authorized to proceed.';
    case RELS = 'Carrier released, the carrier has released the container for delivery or pickup.';
    case UNKNOWN = 'Unknown';

    public function label(): string
    {
        return match($this) {
            OceanCargoEventStatus::STUF => '已装箱',
            OceanCargoEventStatus::STRP => '已拆箱',
            OceanCargoEventStatus::LOAD => '已装载',
            OceanCargoEventStatus::DISC => '已卸货',
            OceanCargoEventStatus::GTOT => '闸口出',
            OceanCargoEventStatus::GTIN => '闸口入',
            OceanCargoEventStatus::DEPA => '已离港',
            OceanCargoEventStatus::ARRI => '已抵港',
            OceanCargoEventStatus::BERT => '已靠泊',
            OceanCargoEventStatus::HOLD => '放行中止',
            OceanCargoEventStatus::CUST => '海关放行',
            OceanCargoEventStatus::RELS => '承运人放行',
            OceanCargoEventStatus::UNKNOWN => '未知',
        };
    }
}