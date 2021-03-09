<?php
/**
 * NoRouteHandler
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\App\Router;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $frontName = 'cms';
        $controllerPath = 'index';
        $controllerName = 'index';

        $request->setModuleName($frontName)
            ->setControllerName($controllerPath)
            ->setActionName($controllerName);

        return true;
    }
}
