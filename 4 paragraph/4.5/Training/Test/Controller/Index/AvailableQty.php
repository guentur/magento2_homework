<?php

declare(strict_types=1);

namespace Training\Test\Controller\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\RequestInterface;

use Magento\Framework\Exception\LocalizedException;
use Training\Test\Model\StockInfoProvider;

use Magento\Framework\Exception\NoSuchEntityException;

//use Magento\Framework\App\Action\HttpGetActionInterface;
//class AvailableQty implements HttpGetActionInterface
class AvailableQty implements \Magento\Framework\App\ActionInterface
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var StockInfoProvider
     */
    private $stockInfoProvider;

    /**
     * @param JsonFactory $resultFactory
     * @param StockInfoProvider $stockInfoProvider
     * @param RequestInterface $request
     */
    public function __construct(
        JsonFactory $resultFactory,
        StockInfoProvider $stockInfoProvider,
        RequestInterface $request
    ) {
        $this->resultJsonFactory = $resultFactory;
        $this->stockInfoProvider = $stockInfoProvider;
        $this->request = $request;
    }

    /**
     * @return ResultInterface
     */
    public function execute() : ResultInterface
    {
        $productSku = $this->request->getParam('productSku');
        $resultJson = $this->resultJsonFactory->create();

        $resultData = [];
        if ($productSku) {
            try {
                $resultData['available_qty'] = $this->stockInfoProvider->getProductSalableQty($productSku);
                $resultData['status'] = 'success';
            } catch (NoSuchEntityException|LocalizedException $e) {
                $resultData = [
                    'status' => 'error',
                    'trace' => $e->getTrace()
                ];
            }
        }
        return $resultJson->setData($resultData);
    }
}
