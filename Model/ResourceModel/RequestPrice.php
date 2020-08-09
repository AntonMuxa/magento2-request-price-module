<?php

namespace MageMiha\RequestPrice\Model\ResourceModel;

class RequestPrice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('request_price', 'request_id');
    }
}
