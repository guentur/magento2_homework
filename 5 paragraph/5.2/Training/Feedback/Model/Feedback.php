<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;

class Feedback extends AbstractModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected function _construct()
    {
        parent::_init(\Training\Feedback\Model\ResourceModel\Feedback::class);
    }

    public function getMessage()
    {
        return $this->getData('content');
    }

    public function getAuthorName()
    {
        return $this->getData('author_name');
    }
}
