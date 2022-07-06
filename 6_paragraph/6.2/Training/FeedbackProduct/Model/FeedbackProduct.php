<?php
namespace Training\FeedbackProduct\Model;

/**
 * Class FeedbackProduct
 */
class FeedbackProduct extends \Magento\Framework\Model\AbstractModel implements
    \Training\FeedbackProduct\Api\Data\FeedbackProductInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'training_feedback_product';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
