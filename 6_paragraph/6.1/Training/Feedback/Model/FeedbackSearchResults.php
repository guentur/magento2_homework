<?php

declare(strict_types=1);

namespace Training\Feedback\Model;

use Magento\Customer\Api\Data\CustomerSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Feedback search results.
 */
class FeedbackSearchResults extends SearchResults implements CustomerSearchResultsInterface
{
}
