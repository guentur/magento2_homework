<?php

namespace Training\FeedbackProduct\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class RelatedProducts implements ArgumentInterface
{
    public function getRelatedProducts(\Training\Feedback\Api\Data\FeedbackInterface $feedback): array
    {
        if (($relatedProducts = $feedback->getExtensionAttributes()->getRelatedProducts()) === null) {
            return [];
        }
        return $relatedProducts;
    }
}
