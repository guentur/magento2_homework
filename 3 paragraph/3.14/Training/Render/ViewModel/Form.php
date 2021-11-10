<?php
/**
 * Form
 */

namespace Training\Render\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Form implements ArgumentInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;

    /**
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getSubmitUrl():string
    {
        return $this->urlBuilder->getUrl('customer/account/login');
    }
}
