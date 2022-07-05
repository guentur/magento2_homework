<?php

namespace Training\CustomerPersonalSite\ViewModels;

use Magento\Customer\Api\Data\CustomerInterface;
use Training\CustomerPersonalSite\Setup\Patch\Data\AddPersonalSiteCustomerAttribute;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CustomerAttribute implements ArgumentInterface
{
    /**
     * @param CustomerInterface $customerData
     * @return string
     */
    public function getPersonalSiteAttribute(CustomerInterface $customerData)
    {
        $attribute = $customerData->getCustomAttribute(AddPersonalSiteCustomerAttribute::ATTRIBUTE_CODE);

        if ($attribute) {
            return $attribute->getValue();
        }
        return '';
    }
}
