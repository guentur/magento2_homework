<?php

declare(strict_types=1);

namespace Training\Feedback\Api\Data;

interface FeedbackInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**#@+*/
    const FEEDBACK_ID = 'entity_id';
    const AUTHOR_NAME = 'author_name';
    const AUTHOR_EMAIL = 'email';
    const MESSAGE = 'content';
    const CREATION_TIME = 'created_at';
    const UPDATE_TIME = 'updated_at';
    const IS_ACTIVE = 'is_active';
    /**#@-*/

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $feedbackId
     * @return FeedbackInterface
     */
    public function setId($feedbackId);

    /**
     * @return string|null
     */
    public function getAuthorName();

    /**
     * @param string $authorName
     * @return FeedbackInterface
     */
    public function setAuthorName(string $authorName);

    /**
     * @return string
     */
    public function getAuthorEmail();

    /**
     * @param string $authorEmail
     * @return FeedbackInterface
     */
    public function setAuthorEmail(string $authorEmail);

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     * @return FeedbackInterface
     */
    public function setMessage(string $message);

    /**
     * @return string
     */
    public function getCreationTime();

    /**
     * @param string $creationTime
     * @return FeedbackInterface
     */
    public function setCreationTime(string $creationTime);

    /**
     * @return string
     */
    public function getUpdateTime();

    /**
     * @param string $updateTime
     * @return FeedbackInterface
     */
    public function setUpdateTime(string $updateTime);

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @param int|bool $isActive
     * @return FeedbackInterface
     */
    public function setIsActive($isActive): FeedbackInterface;

    /**
     * Retrieve existing extension attributes object.
     *
     * @return \Training\Feedback\Api\Data\FeedbackExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
//        \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes
        \Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes
    );
}
