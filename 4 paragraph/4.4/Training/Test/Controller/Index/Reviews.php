<?php

namespace Training\Test\Controller\Index;

use Magento\Framework\Controller\Result\JsonFactory;
//use Magento\Framework\App\Action\HttpGetActionInterface;

//class Reviews implements HttpGetActionInterface
class Reviews implements \Magento\Framework\App\ActionInterface
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    public function __construct(
        JsonFactory $resultFactory
    ) {
        $this->resultJsonFactory = $resultFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() : \Magento\Framework\Controller\ResultInterface
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($this->getRandomReviewData());
    }

    private function getRandomReviewData()
    {
        $reviews = [
            [
                'name' => 'John Smith',
                'message' => 'Duis id mollis lectus. Class aptent taciti sociosqu ad litora torquent
per conubia nostra, per inceptos himenaeos. Integer lacinia est sed eros viverra mattis. Integer
pretium nisi et libero venenatis, ac placerat orci imperdiet. In et lacus tincidunt, bibendum ipsum ac,
scelerisque est. Nullam ornare, neque sit amet malesuada sollicitudin.'
            ],
            [
                'name' => 'Reviewer 2',
                'message' => 'Duis id mollis lectus. Class aptent taciti sociosqu ad litora torquent
per conubia nostra, per inceptos himenaeos. Integer lacinia est sed eros viverra mattis. Integer
pretium nisi et libero venenatis, ac placerat orci imperdiet. In et lacus tincidunt, bibendum ipsum ac,
scelerisque est. Nullam ornare, neque sit amet malesuada sollicitudin.'
            ],
            [
                'name' => 'Reviewer 3',
                'message' => 'Duis id mollis lectus. Class aptent taciti sociosqu ad litora torquent
per conubia nostra, per inceptos himenaeos. Integer lacinia est sed eros viverra mattis. Integer
pretium nisi et libero venenatis, ac placerat orci imperdiet. In et lacus tincidunt, bibendum ipsum ac,
scelerisque est. Nullam ornare, neque sit amet malesuada sollicitudin.'
            ],
            [
                'name' => 'Reviewer 4',
                'message' => 'Duis id mollis lectus. Class aptent taciti sociosqu ad litora torquent
per conubia nostra, per inceptos himenaeos. Integer lacinia est sed eros viverra mattis. Integer
pretium nisi et libero venenatis, ac placerat orci imperdiet. In et lacus tincidunt, bibendum ipsum ac,
scelerisque est. Nullam ornare, neque sit amet malesuada sollicitudin.'
            ],

        ];

        return $reviews[rand(0, 3)];
    }
}
