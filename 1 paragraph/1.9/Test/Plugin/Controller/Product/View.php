<?php
/**
 * View
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Plugin\Controller\Product;


class View
{
    protected $customerSession;
    protected $redirectFactory;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
    }
    public function aroundExecute(
        \Training\Test\Plugin\Controller\Product\View $subject,
        \Closure $proceed
    ) {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
        return $proceed();
    }
}
