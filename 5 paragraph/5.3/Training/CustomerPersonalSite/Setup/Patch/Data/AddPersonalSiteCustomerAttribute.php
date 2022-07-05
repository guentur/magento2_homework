<?php

declare(strict_types=1);

namespace Training\CustomerPersonalSite\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
* Patch is mechanism, that allows to do atomic upgrade data changes
*/
class AddPersonalSiteCustomerAttribute implements DataPatchInterface
{
    const ATTRIBUTE_CODE = 'personal_site';

    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            self::ATTRIBUTE_CODE,
            [
            'type' => 'static',
            'label' => 'Personal Site URL',
            'input' => 'text',
            'validate_rules' => '{"max_text_length":250,"input_validation":"url","validate-url":true}',
            'system' => 0, // <-- important
            'required' => false,
            'user_defined' => true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => true,
            'unique' => true,
            'sort_order' => 300,
            'position' => 300,
            'group' => 'General'
        ]);
        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY, self::ATTRIBUTE_CODE);
        $data = [
            ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
            ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
            ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId],
        ];
        $adapter = $this->moduleDataSetup->getConnection();
        $adapter->insertMultiple($adapter->getTableName('customer_form_attribute'), $data);
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
