<?php

namespace Training\FeedbackProduct\Observer;

use Magento\Framework\Event\ObserverInterface;
use Training\FeedbackProduct\Model\FeedbackDataLoader;

class LoadFeedbackProducts implements ObserverInterface
{
    /**
     * @var \Training\FeedbackProduct\Model\FeedbackProduct
     */
    private $feedbackProducts;

    /**
     * @var FeedbackDataLoader
     */
    private $feedbackDataLoader;

    /**
     * @param \Training\FeedbackProduct\Model\FeedbackProduct $feedbackProducts
     */
    public function __construct(
        \Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct $feedbackProducts,
        FeedbackDataLoader $feedbackDataLoader
    ) {
        $this->feedbackProducts = $feedbackProducts;
        $this->feedbackDataLoader = $feedbackDataLoader;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $feedback = $observer->getFeedback();
        $productIds = $this->feedbackProducts->loadProductRelations($feedback);
        $this->feedbackDataLoader->addProductsToFeedbackByIds($feedback, $productIds);
    }
}
