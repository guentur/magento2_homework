<?php

namespace Training\Feedback\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\Timezone;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResourceModel;

class FeedbackList extends Template
{
    const PAGE_SIZE = 3;

    private $collectionFactory;
    private $timezone;
    private $feedbackResourceModel;
    private $collection;

    public function __construct(
        CollectionFactory $collectionFactory,
        Timezone $timezone,
        FeedbackResourceModel $feedbackResourceModel,
        Template\Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
        $this->feedbackResourceModel = $feedbackResourceModel;
        parent::__construct($context, $data);
    }

    /**
     * @return FeedbackResourceModel\Collection
     */
    public function getFeedbackCollection(): FeedbackResourceModel\Collection
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active',
                \Training\Feedback\Model\Feedback::STATUS_ACTIVE);
            $this->collection->setOrder('created_at', 'ASC');
        }
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getPaginationHtml(): string
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

    /**
     * @return string
     */
    public function getAllFeedbacksCount(): string
    {
        return $this->feedbackResourceModel->getAllFeedbacksCount();
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return self::PAGE_SIZE;
    }

    /**
     * @param $feedback
     * @return false|string
     */
    public function getFeedbackDate($feedback): string
    {
       return $this->timezone->formatDateTime($feedback->getCreationTime());
    }

}
