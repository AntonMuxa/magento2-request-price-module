<?php

namespace MageMiha\RequestPrice\Model\Repository;

use MageMiha\RequestPrice\Api\Data\RequestPriceInterface;
use MageMiha\RequestPrice\Api\Data\RequestPriceSearchResultInterface;
use MageMiha\RequestPrice\Api\Data\RequestPriceSearchResultInterfaceFactory;
use MageMiha\RequestPrice\Api\Repository\RequestPriceRepositoryInterface;
use MageMiha\RequestPrice\Model\ResourceModel\RequestPrice\CollectionFactory as RequestPriceCollectionFactory;
use MageMiha\RequestPrice\Model\RequestPriceFactory;
use MageMiha\RequestPrice\Model\ResourceModel\RequestPrice as RequestPriceResourceModel;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class RequestPriceRepository implements RequestPriceRepositoryInterface
{
    /**
     * @var RequestPriceFactory
     */
    private $requestPriceFactory;
    /**
     * @var RequestPriceCollectionFactory
     */
    private $requestPriceCollectionFactory;
    /**
     * @var RequestPriceSearchResultInterfaceFactory
     */
    private $requestPriceSearchResultInterfaceFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var RequestPriceResourceModel
     */
    private $requestPriceResourceModel;

    public function __construct(
        RequestPriceFactory $requestPriceFactory,
        RequestPriceResourceModel $requestPriceResourceModel,
        CollectionProcessorInterface $collectionProcessor,
        RequestPriceCollectionFactory $requestPriceCollectionFactory,
        RequestPriceSearchResultInterfaceFactory $requestPriceSearchResultInterfaceFactory
    ) {
        $this->requestPriceFactory = $requestPriceFactory;
        $this->requestPriceResourceModel = $requestPriceResourceModel;
        $this->collectionProcessor = $collectionProcessor;
        $this->requestPriceCollectionFactory = $requestPriceCollectionFactory;
        $this->requestPriceSearchResultInterfaceFactory = $requestPriceSearchResultInterfaceFactory;
    }
    public function getById(int $request_id): RequestPriceInterface
    {
        $requestPrice = $this->requestPriceFactory->create();
        $this->requestPriceResourceModel->load($requestPrice, $request_id);

        if (empty($requestPrice->getId())) {
            throw new NoSuchEntityException(__('Request Price id %1 not found', $request_id));
        }

        return $requestPrice;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): RequestPriceSearchResultInterface
    {
        $collection = $this->requestPriceCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->requestPriceSearchResultInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function save(RequestPriceInterface $requestPrice): RequestPriceInterface
    {
        try {
            $this->requestPriceResourceModel->save($requestPrice);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Request Price: %1',
                $exception->getMessage()
            ));
        }
        return $requestPrice;
    }

    public function delete(RequestPriceInterface $requestPrice): RequestPriceRepositoryInterface
    {
        try {
            $requestPriceModel = $this->requestPriceFactory->create();
            $this->requestPriceResourceModel->load($requestPriceModel, $requestPrice->getRequestpriceId());
            $this->requestPriceResourceModel->delete($requestPriceModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Request price: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById(int $requestPriceId): RequestPriceRepositoryInterface
    {
        return $this->delete($this->get($requestPriceId));
    }
}
