<?php

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\Entity\Taxonomy;
use Post\Form\TaxForm;
use Post\Paginator\Paginator;
use Post\Model\CategoryModel;
use ORM\Registry\Registry;

class CategoryController extends AbstractActionController
{

    /**
     * 
     * @return \Post\Model\CategoryModel
     */
    protected function loadModel()
    {
        return new CategoryModel($this->getServiceLocator());
    }

    /**
     *
     * @return \ORM\Registry\ORMRegistry
     */
    protected function RegisterEntityManager()
    {
        return Registry::set("entityManager", $this->loadModel()->getEntityManager());
    }

    public function indexAction()
    {
        $page = (int) $this->params()->fromQuery('page', 1);
        $max = 19;
        $results = $this->loadModel()->findAllByQuery((int) $page, $max);
        $taxonomy = new Paginator($results, $max, $page, 6);
        return new ViewModel([
            'taxonomy' => $taxonomy,
            'taxcount' => $taxonomy->getPageCount()
        ]);
    }

    public function addAction()
    {
        $this->RegisterEntityManager();
        $taxparent = $this->loadModel()->findAll();
        $tax = new Taxonomy();
        $form = new TaxForm();
        $form->bind($tax);

        $request = $this->getRequest();

        $page = (int) $this->params()->fromQuery('page', 1);
        $max = 19;

        $results = $this->loadModel()->findAllByQuery((int) $page, $max);
        $taxonomy = new Paginator($results, $max, $page, 3);

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->loadModel()->save($tax);
                $this->redirect()->toRoute('post/post_category');
            }
        }
        return new ViewModel([
            'form' => $form,
            'taxparent' => $taxparent,
            'taxonomy' => $taxonomy,
            'taxcount' => $taxonomy->getPageCount()
        ]);
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $taxid = $request->isPost() ? $request->getPost()->tax["id"] : (int) $this->params('id', null);
        $this->RegisterEntityManager();
        $taxparent = $this->loadModel()->findAll();
        $tax = $this->loadModel()->findById($taxid);
        $form = new TaxForm();
        $form->bind($tax);

        $page = (int) $this->params()->fromQuery('page', 1);
        $max = 19;
        $results = $this->loadModel()->findAllByQuery((int) $page, $max);
        $taxonomy = new Paginator($results, $max, $page, 3);

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->loadModel()->save($tax, $taxid);
                $this->redirect()->toRoute('post/post_category');
            }
        }

        return new ViewModel([
            'form' => $form,
            'taxonomy' => $taxonomy,
            'taxid' => $taxid,
            'taxparent' => $taxparent,
            'taxcount' => $taxonomy->getPageCount()
        ]);
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        $taxid = $request->isPost() ? $request->getPost()->tax["id"] : (int) $this->params('id', null);
        if (null === $taxid) {
            return $this->redirect()->toRoute('post/post_category');
        }
        $this->loadModel()->delete($taxid);
        $this->redirect()->toRoute('post/post_category');
    }

}
