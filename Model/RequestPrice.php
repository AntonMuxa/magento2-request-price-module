<?php

use MageMiha\RequestPrice\Api\Model\RequestPriceInterface;

class RequestPrice implements RequestPriceInterface
{

    public function getRequestId()
    {
        return $this->_getData(self::REQUEST_ID);
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function getEmail()
    {
        return $this->_getData(self::EMAIL);
    }

    public function getComment()
    {
        return $this->_getData(self::COMMENT);
    }

    public function getProductSku()
    {
        return $this->_getData(self::PRODUCT_SKU);
    }

    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    public function getCreatedAt()
    {
        return $this->_getData(self::CREATE_AT);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    public function setProductSku($productSku)
    {
        return $this->setData(self::PRODUCT_SKU, $productSku);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATE_AT, $createdAt);
    }
}
