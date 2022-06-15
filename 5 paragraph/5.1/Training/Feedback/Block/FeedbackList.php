<?php

namespace Training\Feedback\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\Timezone;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;

class FeedbackList extends Template
{
    const PAGE_SIZE = 3;

    private $collectionFactory;
    private $timezone;
    private $collection;

    public function __construct(
        CollectionFactory $collectionFactory,
        Timezone $timezone,
        Template\Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
        parent::__construct($context, $data);
    }

    /**
     * @return \Training\Feedback\Model\ResourceModel\Feedback\Collection
     */
    public function getFeedbackCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('created_at', 'ASC');
        }
        return $this->collection;
    }

    /**
     * @return \Magento\Framework\DataObject|\Magento\Framework\View\Element\AbstractBlock|string
     */
    public function getPaginationHtml()
    {
        $pageBlock = $this->getChildBlock('feedback_list_pager');
        if ($pageBlock instanceof \Magento\Framework\DataObject) {
            /* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
            $pageBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getFeedbackCollection());
            return $pageBlock->toHtml();
        }
        return '';
    }

    public function getLimit()
    {
        return self::PAGE_SIZE;
    }

    public function getFeedbackDate($feedback)
    {
       return $this->timezone->formatDateTime($feedback->getCreationTime());
    }

}
