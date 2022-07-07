<?php

namespace Training\Feedback\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;

class IsActiveFilter implements CustomFilterInterface
{
    /**
     * Just for demonstrating. You should use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor
     * directly in this logic for having ability to use FieldMapping
     *
     * @param Filter $filter
     * @param AbstractDb $collection
     * @return bool
     */
    public function apply(Filter $filter, AbstractDb $collection): bool
    {
        $field = $filter->getField(); //$field = $this->getFieldMapping($filter->getField()); in Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor
        $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
        $field = ['attribute' => $field, $condition => $filter->getValue()];

        /** @var \Magento\Cms\Model\ResourceModel\Block\Collection $collection */
        $collection->addFieldToFilter($field);

        return true;
    }

}
