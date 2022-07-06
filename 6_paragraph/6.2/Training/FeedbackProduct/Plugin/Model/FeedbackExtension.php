<?php

namespace Training\FeedbackProduct\Plugin\Model;

use Training\Feedback\Api\Data\FeedbackInterface;
use Training\Feedback\Api\Data\FeedbackExtensionInterfaceFactory;

class FeedbackExtension
{
    private $extensionAttributesFactory;

    public function __construct(
        FeedbackExtensionInterfaceFactory $feedbackExtensionFactory
    ) {
        $this->extensionAttributesFactory = $feedbackExtensionFactory;
    }

    public function afterGetExtensionAttributes(FeedbackInterface $subject, $result)
    {
        if (!is_null($result)) {
            return $result;
        }
        /** @var \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes */
        $extensionAttributes = $this->extensionAttributesFactory->create();
        $subject->setExtensionAttributes($extensionAttributes);
        return $extensionAttributes;
    }
}
