<?php
/**
 * LogPageHtml
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class LogPageHtml implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $response = $observer->getEvent()->getData('request');
        $this->logger->debug($response->getBody());
    }
}
