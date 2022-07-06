<?php

namespace Training\Feedback\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class FeedbackForm implements ArgumentInterface
{
    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getFeedbackFormActionUrl()
    {
        return $this->urlBuilder->getUrl('feedback/feedback/add');
    }

    public function getFeedbackFormUrl()
    {
        return $this->urlBuilder->getUrl('feedback/feedback/form');
    }
}
