<?php

namespace Training\Feedback\Api;

/**
 * Feedback CRUD interface.
 * @api
 * @since 100.0.2
 */
interface FeedbackRepositoryInterface
{
    /**
     * Create or update a Feedback.
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If the provided email is already used
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Training\Feedback\Api\Data\FeedbackInterface $feedback);

    /**
     * Get Feedback by Feedback ID.
     *
     * @param int $feedbackId
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If feedback with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($feedbackId);

    /**
     * Retrieve Feedback which match a specified criteria.
     *
     * This call returns an array of objects, but detailed information about each object’s attributes might not be
     * included. See https://devdocs.magento.com/codelinks/attributes.html#CustomerRepositoryInterface to determine
     * which call to use to get detailed information about all attributes for an object.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Customer\Api\Data\CustomerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Feedback.
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Training\Feedback\Api\Data\FeedbackInterface $feedback);

    /**
     * Delete Feedback by Feedback ID.
     *
     * @param int $feedbackId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($feedbackId);
}
