<?php

namespace Training\Test\App;

use Magento\Framework\App\AreaList;
use Magento\Framework\App\Request\ValidatorInterface as RequestValidator;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterListInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\State;
use Magento\Framework\Message\ManagerInterface as MessageManager;

class FrontController extends \Magento\Framework\App\FrontController
{
    /**
     * @var \Magento\Framework\App\RouterListInterface
     */
    protected $routerList;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $response;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Logger\Monolog
     */
    private $monolog;

    /**
     * FrontController constructor.
     * @param \Magento\Framework\App\RouterListInterface $routerList
     * @param \Magento\Framework\App\ResponseInterface $response
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Logger\Monolog $monolog
     */
    public function __construct(
        \Magento\Framework\App\RouterListInterface $routerList,
        \Magento\Framework\App\ResponseInterface $response,
        \Magento\Framework\Logger\Monolog $monolog,
        ?RequestValidator $requestValidator = null,
        ?MessageManager $messageManager = null,
        ?LoggerInterface $logger = null,
        ?State $appState = null,
        ?AreaList $areaList = null
    ) {
        $this->routerList = $routerList;
        $this->response = $response;
        $this->logger = $logger;
        $this->monolog = $monolog;

        parent::__construct($routerList, $response, $requestValidator, $messageManager, $logger, $appState, $areaList);
    }

    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        foreach ($this->routerList as $router) {
            $this->monolog->info(get_class($router));
        }
        return parent::dispatch($request);
    }
}
