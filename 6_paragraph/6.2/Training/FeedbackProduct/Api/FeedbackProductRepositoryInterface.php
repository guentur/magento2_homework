<?php
namespace Training\FeedbackProduct\Api;

use Training\FeedbackProduct\Api\Data\FeedbackProductInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface FeedbackProductRepositoryInterface
 *
 * @api
 */
interface FeedbackProductRepositoryInterface
{
    /**
     * Create or update a FeedbackProduct.
     *
     * @param FeedbackProductInterface $page
     * @return FeedbackProductInterface
     */
    public function save(FeedbackProductInterface $page);

    /**
     * Get a FeedbackProduct by Id
     *
     * @param int $id
     * @return FeedbackProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If FeedbackProduct with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve FeedbackProducts which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a FeedbackProduct
     *
     * @param FeedbackProductInterface $page
     * @return FeedbackProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If FeedbackProduct with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(FeedbackProductInterface $page);

    /**
     * Delete a FeedbackProduct by Id
     *
     * @param int $id
     * @return FeedbackProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
