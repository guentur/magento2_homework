<?php
/**
 * Index
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\TestOM\Controller\Index;

class Index implements \Magento\Framework\App\ActionInterface
{
    private $test;

    /**
     * Index constructor.
     * @param \Training\TestOM\Model\PlayWithTest $test
     */
    public function __construct(
        \Training\TestOM\Model\PlayWithTest $test
    ) {
        $this->test = $test;
    }

    public function execute()
    {
        $this->test->run();
        exit();
    }
}

