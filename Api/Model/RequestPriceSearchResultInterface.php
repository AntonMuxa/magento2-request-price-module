<?php


namespace MageMiha\RequestPrice\Api\Model;

use Magento\Framework\Api\SearchResultsInterface;

interface RequestPriceSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \MageMiha\RequestPrice\Api\Model\RequestPriceInterface[]
     */
    public function getItems();

    /**
     * @param \MageMiha\RequestPrice\Api\Model\RequestPriceInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
