<?php

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Post\Model\CategoryModel;

class CategoryController extends AbstractActionController
{

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $page = (int) $this->params()->fromQuery('page', 1);
        $keyword = $this->getRequest()->isPost() ? $this->getRequest()->getPost()->search['keyword'] : $this->params()->fromQuery('keyword');
        $paginator = $this->getModel()->getPaginatorWithKey($keyword, $page, (int) 19);
        return new ViewModel([
            'taxonomy' => $paginator,
            'taxcount' => $paginator->getPageCount(),
            'keyword' => $keyword,
            'formsearch' => $this->getModel()->getFormSearch()
        ]);
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {

        $tax = $this->getModel()->getEntity();
        $form = $this->getModel()->getForm($tax);
        $page = (int) $this->params()->fromQuery('page', 1);
        $keyword = $this->getRequest()->isPost() ? $this->getRequest()->getPost()->search['keyword'] : $this->params()->fromQuery('keyword');
        $paginator = $this->getModel()->getPaginatorWithKey($keyword, $page, (int) 19, 2);

        if (isset($this->getRequest()->getPost()->tax) && $this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $this->getRequest()->getPost()->tax["slug"] == null ? $tax->setSlug($this->getRequest()->getPost()->tax["name"]) : $tax->setSlug($this->getRequest()->getPost()->tax["slug"]);
                $this->getModel()->save($tax);
                $this->redirect()->toRoute('post/post_category');
            }
        }
        return new ViewModel([
            'form' => $form,
            'taxparent' => $this->getModel()->findAll(),
            'taxonomy' => $paginator,
            'taxcount' => $paginator->getPageCount(),
            'formsearch' => $this->getModel()->getFormSearch(),
            'keyword' => $keyword,
        ]);
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $page = (int) $this->params()->fromQuery('page', 1);
        $tax = $this->getModel()->getObjectRepository()->find($this->getId());
        $form = $this->getModel()->getForm($tax);
        $keyword = $this->getRequest()->isPost() ? $this->getRequest()->getPost()->search['keyword'] : $this->params()->fromQuery('keyword');
        $paginator = $this->getModel()->getPaginatorWithKey($keyword, $page, (int) 19);
        if (isset($this->getRequest()->getPost()->tax) && $this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $this->getRequest()->getPost()->tax["slug"] == null ? $tax->setSlug($this->getRequest()->getPost()->tax["name"]) : $tax->setSlug($this->getRequest()->getPost()->tax["slug"]);
                $this->getModel()->save($tax);
                $this->redirect()->toRoute('post/post_category');
            }
        }

        return new ViewModel([
            'form' => $form,
            'taxid' => $this->getId(),
            'taxonomy' => $paginator,
            'taxparent' => $this->getModel()->findAll(),
            'taxcount' => $paginator->getPageCount(),
            'formsearch' => $this->getModel()->getFormSearch(),
            'keyword' => $keyword,
        ]);
    }

    /**
     * 
     */
    public function deleteAction()
    {
        $this->getModel()->delete($this->getId());
        $this->redirect()->toRoute('post/post_category');
    }

    /**
     * 
     * @return type
     */
    protected function getId()
    {
        $tax = isset($this->getRequest()->getPost()->tax) ? $this->getRequest()->getPost()->tax['id'] : (int) $this->params('id', null);
        $serch = isset($this->getRequest()->getPost()->search) ? $this->getRequest()->getPost()->search['id'] : (int) $this->params('id', null);
        $id = isset($this->getRequest()->getPost()->tax) ? $tax : $serch;
        if (null == $id || $this->getModel()->findByPk($id) == null) {
            $this->redirect()->toRoute('post/post_category');
        } else {
            return $id;
        }
    }

    /**
     * 
     * @return \Post\Model\CategoryModel
     */
    protected function getModel()
    {
        return new CategoryModel($this->getServiceLocator());
    }

}
