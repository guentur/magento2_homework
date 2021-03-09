<?php
/**
 * View
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Controller\Product;

use Magento\Catalog\Helper\Product\View as ViewHelper;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class View extends \Magento\Catalog\Controller\Product\View
{
    protected $customerSession;

    protected $resultRedirectFactory;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Context $context,
        ViewHelper $viewHelper,
        ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        \Psr\Log\LoggerInterface $logger = null,
        \Magento\Framework\Json\Helper\Data $jsonHelper = null
    ) {
        $this->customerSession = $customerSession;
        $this->resultRedirectFactory = $resultRedirectFactory;

        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory, $logger, $jsonHelper);
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->resultRedirectFactory->create()->setPath('customer/account/login');
        }
        return parent::execute();
    }
}
