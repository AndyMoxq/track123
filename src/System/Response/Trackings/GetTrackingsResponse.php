<?php
namespace Track123\OpenApi\System\Response\Trackings;

use Track123\OpenApi\Contracts\Response;

/**
 * Class GetTrackingsResponse
 * 用于解析轨迹查询接口的响应内容
 */
class GetTrackingsResponse extends Response {

    /**
     * 获取内容数组
     *
     * @return array
     */
    public function getContent(): array {
        return $this->getData()['accepted']['content'] ?? [];
    }

    /**
     * 获取总元素数量
     *
     * @return int
     */
    public function getTotal(): int {
        return $this->getData()['accepted']['totalElements'] ?? 0;
    }

    /**
     * 获取总页数
     *
     * @return int
     */
    public function getTotalPages(): int {
        return $this->getData()['accepted']['totalPages'] ?? 0;
    }

    /**
     * 获取当前页码
     *
     * @return int
     */
    public function getCurrentPage(): int {
        return $this->getData()['accepted']['currentPage'] ?? 0;
    }

    /**
     * 获取分页游标（如存在）
     *
     * @return string|null
     */
    public function getCursor(): ?string {
        return $this->getData()['accepted']['cursor'] ?? null;
    }

    /**
     * 判断是否还有下一页
     *
     * @return bool
     */
    public function hasNextPage(): bool {
        return $this->getCurrentPage() < $this->getTotalPages();
    }

    public function getRejected(): array{
      return $this -> getData()['rejected'] ?? [];
    }
}