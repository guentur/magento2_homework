<?php
/**
 * View
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\Test\Controller\Page;
use Magento\Framework\Exception\NoSuchEntityException;

class View extends \Magento\Cms\Controller\Page
{
    protected $resultJsonFactory;
    protected $pageRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageRepository = $pageRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isAjax()) {
            $data = ['status' => 'success', 'message' => ''];

            $pageId = $this->getRequest->getParam('page_id', $this->getRequest()->getParam('id', false));
            $resultJson = $this->resultJsonFactory->create();

            try {
                $page = $this->pageRepository->getById($pageId);
                $data['title'] = $page->getTitle();
                $data['content'] = $page->getContent();
            } catch (NoSuchEntityException $e) {
                $data['status'] = 'error';
                $data['message'] = 'Not found';
            } catch (\Exception $e) {
                $data['status'] = 'error';
                $data['message'] = 'Something wrong';
            }
            $resultJson->setData($data);
            return $resultJson;
        }
        return parent::execute();
    }
}
