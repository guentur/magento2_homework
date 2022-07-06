<?php
namespace Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(
            \Training\FeedbackProduct\Model\FeedbackProduct::class,
            \Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct::class
        );
    }
}
