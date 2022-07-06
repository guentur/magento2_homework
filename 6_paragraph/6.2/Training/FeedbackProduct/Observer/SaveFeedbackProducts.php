<?php

namespace Training\FeedbackProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveFeedbackProducts implements ObserverInterface
{
    private $feedbackProducts;

    public function __construct(
        \Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct $feedbackProducts
    ) {
        $this->feedbackProducts = $feedbackProducts;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $feedback = $observer->getFeedback();
        $relatedProducts = $feedback->getExtensionAttributes()->getRelatedProducts();
        $relatedProductIds = [];
        /** @var \Magento\Catalog\Api\Data\ProductInterface $relatedProduct */
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProductIds[] = $relatedProduct->getId();
        }
        $this->feedbackProducts->saveProductRelations($feedback->getId(), $relatedProductIds);
    }
}
