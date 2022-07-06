<?php

namespace Training\Feedback\Controller\Feedback;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Training\Feedback\Model\FeedbackFactory as FeedbackModelFactory;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResourceModel;
use Magento\Framework\Message\ManagerInterface;

class Add implements HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var RedirectFactory
     */
    protected $redirectF;

    /**
     * @var FeedbackModelFactory
     */
    protected $feedbackF;

    /**
     * @var FeedbackResourceModel
     */
    protected $feedbackResourceModel;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param PageFactory $resultPageFactory
     * @param RedirectFactory $redirectF
     * @param FeedbackModelFactory $feedbackF
     * @param FeedbackResourceModel $feedbackResourceModel
     * @param ManagerInterface $messageManager
     * @param RequestInterface $request
     */
    public function __construct(
        PageFactory $resultPageFactory,
        RedirectFactory $redirectF,
        FeedbackModelFactory $feedbackF,
        FeedbackResourceModel $feedbackResourceModel,
        ManagerInterface $messageManager,
        RequestInterface $request
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->redirectF = $redirectF;
        $this->feedbackF = $feedbackF;
        $this->feedbackResourceModel = $feedbackResourceModel;
        $this->messageManager = $messageManager;
        $this->request = $request;
    }

    /**The resource isn't set. in /home/kyrylo/projects/222/magento24/proj/mage24/vendor/magento/framework/Model/AbstractModel.php on line 476
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $result = $this->redirectF->create();
        if ($post = $this->request->getPostValue()) {
            try {
                $this->validateRequest($post);

                $feedbackModel = $this->feedbackF->create();

                if (!empty($this->request->getParam('author_name'))) {
                    $feedbackModel->setData('author_name', $this->request->getParam('author_name'));
                }

                $requiredData = [
                    'email' => $this->request->getParam('author_email'),
                    'content' => $this->request->getParam('message'),
                    'is_active' => 1,
                ];

                $feedbackModel->setData($requiredData);

                $this->feedbackResourceModel->save($feedbackModel);

            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__('An error occurred while processing your form. Please try again later.'));
            }

        }
        return $result->setPath('*/feedback/list');
    }

    /**
     * @param $post
     * @return void
     * @throws LocalizedException
     */
    private function validateRequest($post)
    {
        if (!isset($post['author_email']) || trim($post['author_email']) === '') {
            throw new LocalizedException(__('Email is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Email is missing'));
        }
        if (trim($this->request->getParam('hideit')) !== '') {
            throw new \Exception();
        }
    }

}
