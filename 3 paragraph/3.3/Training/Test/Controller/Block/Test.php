<?php
/**
 * Test
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Controller\Block;

use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\App\Action\Context;
//use Magento\Backend\App\Action\Context;

class Test extends \Magento\Framework\App\Action\Action
{
    private $layoutFactory;

    private $rawResultFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        RawFactory $rawResultFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->rawResultFactory = $rawResultFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $resultRaw = $this->rawResultFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');

        $resultRaw->setHeader('Content-Type', 'text/html');
        $resultRaw->setContents($block->toHtml());

        return $resultRaw;
    }
}
