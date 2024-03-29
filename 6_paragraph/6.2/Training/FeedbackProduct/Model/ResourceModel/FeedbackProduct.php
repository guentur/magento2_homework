<?php

namespace Training\FeedbackProduct\Model\ResourceModel;

/**
 * Class FeedbackProduct
 */
class FeedbackProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init('training_feedback_product', 'entity_id');
    }

    public function saveProductRelations($feedbackId, $productIds)
    {
        $savedProductIds = $this->loadProductRelations($feedbackId);
        $productIdsToAdd = array_diff($productIds, $savedProductIds);
        $productIdsToDelete = array_diff($savedProductIds, $productIds);
        $dataToAdd = [];
        foreach ($productIdsToAdd as $productId) {
            $dataToAdd[] = ['feedback_id' => $feedbackId, 'product_id' => $productId];
        }
        if (count($dataToAdd)) {
            $this->getConnection()->insertMultiple(
                $this->getTable('training_feedback_product'),
                $dataToAdd
            );
        }
        if (count($productIdsToDelete)) {
            $this->getConnection()->delete(
                $this->getTable('training_feedback_product'),
                ['feedback_id = ?' => $feedbackId, 'product_id IN (?)' => $productIdsToDelete]
            );
        }
        return $this;
    }

    public function loadProductRelations($feedbackId)
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->getTable('training_feedback_product'), 'product_id')
            ->where('feedback_id = ?', (int) $feedbackId);
        return $adapter->fetchCol($select);
    }
}
