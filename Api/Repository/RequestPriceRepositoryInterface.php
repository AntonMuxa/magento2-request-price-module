<?php

namespace MageMiha\RequestPrice\Api\Repository;

use MageMiha\RequestPrice\Api\Model\RequestPriceInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use MageMiha\RequestPrice\Api\Model\RequestPriceSearchResultInterface;

interface RequestPriceRepositoryInterface
{
    /**
     * Get user by ID
     *
     * @param int $request_id
     * @throws NoSuchEntityException
     * @return RequestPriceInterface
     */
    public function getById(int $request_id) : RequestPriceInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \MageMiha\RequestPrice\Api\Model\RequestPriceSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : RequestPriceSearchResultInterface;

    /**
     * @param RequestPriceInterface $request_price
     * @throws CouldNotSaveException
     * @return RequestPriceInterface
     */
    public function save(RequestPriceInterface $request_price) : RequestPriceInterface;

    /**
     * @param RequestPriceInterface $request_price
     * @throws CouldNotDeleteException
     * @return RequestPriceRepositoryInterface
     */
    public function delete(RequestPriceInterface $request_price) : RequestPriceRepositoryInterface;

    /**
     * @param int $request_price
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     * @return RequestPriceRepositoryInterface
     */
    public function deleteById(int $request_id) : RequestPriceRepositoryInterface;
}
