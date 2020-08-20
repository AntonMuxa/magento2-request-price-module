<?php

namespace MageMiha\RequestPrice\Api\Data;


interface RequestPriceInterface
{
    const REQUEST_ID = 'request_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const COMMENT = 'comment';
    const PRODUCT_SKU = 'product_sku';
    const STATUS = 'status';
    const CREATE_AT = 'created_at';

    /**
     * @return mixed
     */
    public function getRequestId();
    /**
     * @return string
     */
    public function getName();
    /**
     * @return string
     */
    public function getEmail();
    /**
     * @return string
     */
    public function getComment();
    /**
     * @return mixed
     */
    public function getProductSku();
    /**
     * @return integer
     */
    public function getStatus();
    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);
    /**
     * Set name
     * @param string $email
     * @return void
     */
    public function setEmail($email);
    /**
     * @param $comment
     * @return void
     */
    public function setComment($comment);

    /**
     * @param $productSku
     * @return void
     */
    public function setProductSku($productSku);
    /**
     * @param $status
     * @return void
     */
    public function setStatus($status);
    /**
     * @param $createdAt
     * @return void
     */
    public function setCreatedAt($createdAt);
}
