<?php

namespace Training\FeedbackProduct\Controller\Feedback;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Training\Feedback\Model\FeedbackFactory as FeedbackModelFactory;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResourceModel;
use Magento\Framework\Message\ManagerInterface;
use Training\Feedback\Controller\Feedback\Add as FeedbackAdd;

class Add extends FeedbackAdd
{
    /**
     * @var \Training\FeedbackProduct\Model\FeedbackDataLoader
     */
    protected $feedbackDataLoader;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param PageFactory $resultPageFactory
     * @param RedirectFactory $redirectF
     * @param FeedbackModelFactory $feedbackF
     * @param FeedbackResourceModel $feedbackResourceModel
     * @param \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository
     * @param ManagerInterface $messageManager
     * @param \Training\FeedbackProduct\Model\FeedbackDataLoader $feedbackDataLoader
     * @param RedirectFactory $resultRedirectFactory
     * @param RequestInterface $request
     */
    public function __construct(
        PageFactory                                        $resultPageFactory,
        RedirectFactory                                    $redirectF,
        FeedbackModelFactory                               $feedbackF,
        FeedbackResourceModel                              $feedbackResourceModel,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        ManagerInterface                                   $messageManager,
        \Training\FeedbackProduct\Model\FeedbackDataLoader $feedbackDataLoader,
        RedirectFactory                                    $resultRedirectFactory,
        RequestInterface                                   $request
    ) {
        parent::__construct($resultPageFactory, $redirectF, $feedbackF, $feedbackResourceModel, $feedbackRepository, $messageManager, $request);
        $this->feedbackDataLoader = $feedbackDataLoader;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($post = $this->request->getPostValue()) {
            try {
                $this->validateRequest($post);
                $feedback = $this->feedbackF->create();
                $this->setFeedbackData($feedback, $post);

                $this->feedbackResourceModel->save($feedback);
                $this->messageManager->addSuccessMessage(
                    __('Thank you for your feedback.')
                );
            } catch(\Exception $e) {
//                $this->messageManager->addErrorMessage(
//                    __('An error occurred while processing your form. Please try again later.')
//                );
                $this->messageManager->addErrorMessage(
                    $e->getMessage()
                );
                echo $e->getMessage();
                echo $e->getTraceAsString();
                exit();
                $resultRedirect->setPath('*/*/form');
            }
        }
        $resultRedirect->setPath('*/*/list');
        return $resultRedirect;
    }

    private function setFeedbackData($feedbackModel, $post)
    {
//        if (!empty($this->request->getParam('author_name'))) {
//            $feedbackModel->setData('author_name', $this->request->getParam('author_name'));
//        }

        $requiredData = [
            'email' => $this->request->getParam('author_email'),
            'content' => $this->request->getParam('message'),
            'is_active' => 1,
            'author_name' => $this->request->getParam('author_name', null),
        ];

        $feedbackModel->setData($requiredData);
        $this->setProductsToFeedback($feedbackModel, $post);
    }

    /**
     * @param $feedback
     * @param $post
     * @return void
     */
    private function setProductsToFeedback($feedback, $post)
    {
        $skus = [];
        if (isset($post['related_products_sku']) && !empty($post['related_products_sku'])) {
            $skus = explode(',', $post['related_products_sku']);
            $skus = array_map('trim', $skus);
            $skus = array_filter($skus);
        }

        $this->feedbackDataLoader->addProductsToFeedbackBySkus($feedback, $skus);
    }

}
