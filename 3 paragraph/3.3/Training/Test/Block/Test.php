<?php
/**
 * Test
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Block;


class Test extends \Magento\Framework\View\Element\AbstractBlock
{
    public function toHtml()
    {
        return '<b>Hello from block!</b>';
    }
}
