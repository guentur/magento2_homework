<?php

namespace Training\Feedback\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for feedback search results.
 * @api
 * @since 100.0.2
 */
interface FeedbackSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get feedback list.
     *
     * @return \Training\Feedback\Api\Data\FeedbackInterface[]
     */
    public function getItems();

    /**
     * Set feedback list.
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
