<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;
use Training\Feedback\Api\Data\FeedbackInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

//class Feedback extends AbstractModel implements FeedbackInterface
class Feedback extends AbstractExtensibleModel implements FeedbackInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'training_feedback';

    /**
     * @var string
     */
    protected $_eventObject = 'feedback';

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_init(\Training\Feedback\Model\ResourceModel\Feedback::class);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getAuthorName()
    {
        return $this->getData(self::AUTHOR_NAME);
    }

    /**
     * @param string $authorName
     * @return FeedbackInterface|void
     */
    public function setAuthorName(string $authorName)
    {
        return $this->setData(self::AUTHOR_NAME, $authorName);
    }

    /**
     * @return string|null
     */
    public function getAuthorEmail()
    {
        return $this->getData(self::AUTHOR_EMAIL);
    }

    /**
     * @param string $authorEmail
     * @return FeedbackInterface|void
     */
    public function setAuthorEmail(string $authorEmail)
    {
        return $this->setData(self::AUTHOR_EMAIL, $authorEmail);
    }

    /**
     * @param string $message
     * @return FeedbackInterface|void
     */
    public function setMessage(string $message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * @param string $creationTime
     * @return FeedbackInterface|Feedback
     */
    public function setCreationTime(string $creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * @param string $updateTime
     * @return FeedbackInterface|void
     */
    public function setUpdateTime(string $updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * @param bool $isActive
     * @return FeedbackInterface
     */
    public function setIsActive($isActive): FeedbackInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @return \Magento\Framework\Api\ExtensionAttributesInterface|\Training\Feedback\Api\Data\FeedbackExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @param \Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes
     * @return Feedback
     */
    public function setExtensionAttributes(\Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
