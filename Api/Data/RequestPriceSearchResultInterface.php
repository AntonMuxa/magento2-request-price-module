<?php


namespace MageMiha\RequestPrice\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface RequestPriceSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \MageMiha\RequestPrice\Api\Data\RequestPriceInterface[]
     */
    public function getItems();

    /**
     * @param \MageMiha\RequestPrice\Api\Data\RequestPriceInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
