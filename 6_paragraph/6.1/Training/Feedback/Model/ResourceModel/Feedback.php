<?php

namespace Training\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDB;

class Feedback extends AbstractDB
{
    protected function _construct()
    {
        $this->_init('training_feedback', 'entity_id');
    }
}
