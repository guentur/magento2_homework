<?php

namespace Training\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDB;

class Feedback extends AbstractDB
{
    protected function _construct()
    {
        $this->_init('training_feedback', 'entity_id');
    }

    /**
     * @return string
     */
    public function getAllFeedbacksCount()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->_mainTable, new \Zend_Db_Expr('COUNT(*)'));
        return $adapter->fetchOne($select);
    }

    public function getActiveFeedbackCount()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->_mainTable, new \Zend_Db_Expr('COUNT(*)'))
            ->where('is_active = ?',
                \Training\Feedback\Model\Feedback::STATUS_ACTIVE);
        return $adapter->fetchOne($select);
    }
}
