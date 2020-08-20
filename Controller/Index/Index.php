<?php

namespace MageMiha\RequestPrice\Controller\Index;

use MageMiha\RequestPrice\Api\Repository\RequestPriceRepositoryInterface;
use MageMiha\RequestPrice\Model\RequestPrice;
use MageMiha\RequestPrice\Model\RequestPriceFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\JsonFactory;

class Index extends Action
{
    public $repository;

    public $modelFactory;
    private $resultJsonFactory;

    public function __construct(
        Context $context,
        RequestPriceRepositoryInterface $repository,
        RequestPriceFactory $modelFactory,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->modelFactory = $modelFactory;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        /*if (!$this->isPostRequest()) {
            return $this->resultRedirectFactory->create()->setPath('/');
        }*/

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */

        $credentials = null;

        try {
            $model = $this->modelFactory->create();
            $credentials = $this->getRequest()->getParams();
            if(!empty($credentials)) {
                $model->setName($credentials['firstname']);
                $model->setEmail($credentials['email']);
                $model->setComment($credentials['comment']);
                $model->setProductSku($credentials['product_sku']);
            }
            $this->repository->save($model);
            $response = [
                'errors' => false,
                'message' => __('Request was sended!')
            ];
        } catch (LocalizedException $e) {
            $response = [
                'errors' => true,
                'message' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'message' => $e->getMessage(),
            ];
        }
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }

    /**
     * @return bool
     */
    private function isPostRequest()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        return !empty($request->getPostValue());
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('name')) === '') {
            throw new LocalizedException(__('Name is missing'));
        }
        if (trim($request->getParam('comment')) === '') {
            throw new LocalizedException(__('Comment is missing'));
        }
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('Invalid email address'));
        }

        return $request->getParams();
    }
}
