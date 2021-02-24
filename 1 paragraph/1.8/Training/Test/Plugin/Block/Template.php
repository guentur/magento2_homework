<?php
/**
 * Template
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Plugin\Block;


class Template
{
    public function afterToHtml(
        \Magento\Framework\View\Element\Template $subject,
        $result
    ) {
        if ($subject->getNameInLayout() == 'top.search') {
            $result = '<div><p>' . $subject->getTemplate() . '</p>'
                . '<p>' . get_class($subject) . '</p>' . $result . '</div>';
        }
        return $result;
    }
}
