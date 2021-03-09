<?php
/**
 * Test
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Controller\Block;

use Magento\Framework\App\Action\Context;
//use Magento\Backend\App\Action\Context;

class Test extends \Magento\Framework\App\Action\Action
{
    private $layoutFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
    ) {
        $this->layoutFactory = $layoutFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        $this->getResponse()->appendBody($block->toHtml());
    }
}
