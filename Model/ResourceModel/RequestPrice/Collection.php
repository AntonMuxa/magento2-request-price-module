<?php

namespace MageMiha\RequestPrice\Model\ResourceModel\RequestPrice;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'request_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MageMiha\RequestPrice\Model\RequestPrice::class,
            \MageMiha\RequestPrice\Model\ResourceModel\RequestPrice::class
        );
    }
}
