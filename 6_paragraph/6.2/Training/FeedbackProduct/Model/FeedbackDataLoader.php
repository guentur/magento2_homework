<?php

namespace Training\FeedbackProduct\Model;

class FeedbackDataLoader
{
    const PRODUCT_ID_FIELD = 'entity_id';
    const PRODUCT_SKU_FIELD = 'sku';

    private $productRepository;
    private $searchCriteriaBuilder;
    private $filterBuilder;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder    $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder            $filterBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    public function addProductsToFeedbackBySkus($feedback, $skus)
    {
        $extensionAttributes = $feedback->getExtensionAttributes()
            ->setRelatedProducts($this->getProductsByField(self::PRODUCT_SKU_FIELD, $skus));
        $feedback->setExtensionAttributes($extensionAttributes);
        return $feedback;
    }

    public function addProductsToFeedbackByIds($feedback, $ids)
    {
        $extensionAttributes = $feedback->getExtensionAttributes()
            ->setRelatedProducts($this->getProductsByField(self::PRODUCT_ID_FIELD, $ids));
        $feedback->setExtensionAttributes($extensionAttributes);
        return $feedback;
    }

    private function getProductsByField($field, $value)
    {
        if (!is_array($value) || !count($value)) {
            return [];
        }
        //@todo
        $fieldFilter = $this->filterBuilder
            ->setField($field)
            ->setValue($value)
            ->setConditionType('in')
            ->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$fieldFilter])
            ->create();
        return $this->productRepository->getList($searchCriteria)->getItems();
    }

}
