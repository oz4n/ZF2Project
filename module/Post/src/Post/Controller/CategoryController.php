<?php

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Post\Model\CategoryModel;
/**
 * Zend Search Lucene
 */
use Search\Lucene\Lucene;
use Search\Lucene\Document;
use Search\Lucene\Field;

class CategoryController extends AbstractActionController
{

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $key = 'linux';
        $index = new Lucene('/media/HD-500/Libraries/Github/ZF2Project/data/cache/SearchModule');
        $results = $index->find($key);
        $data = \Search\Search\QueryParser::parse($key);
        foreach ($results as $v) {
            echo $data->highlightMatches($v->name)."<br>";
        }
//        echo '<pre>';
//        echo $index->numDocs();
////        print_r($a);
//        echo '<pre>';
//        echo 'Berhasil';
//        foreach ($this->getModel()->findAll() as $v) {
//            $document = new Document();
//            $document->addField(Field::text('id', $v->getId(), 'utf-8'));
//            $document->addField(Field::text('name', $v->getName(), 'utf-8'));
//            $document->addField(Field::text('slug', $v->getSlug(), 'utf-8'));
//            $index->addDocument($document);
//        }
//        $index->commit();
        exit();
        $page = (int) $this->params()->fromQuery('page', 1);
        $paginator = $this->getModel()->getPaginator($page, (int) 19);
        return new ViewModel([
            'taxonomy' => $paginator,
            'taxcount' => $paginator->getPageCount()
        ]);
    }

    public function serchAction()
    {
        
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
        $paginator = $this->getModel()->getPaginator($page, (int) 19, 3);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $this->getRequest()->getPost()->tax["slug"] == null ? $tax->setSlug($this->getRequest()->getPost()->tax["name"]) : '';
                $this->getModel()->save($tax);
                $this->redirect()->toRoute('post/post_category');
            }
        }
        return new ViewModel([
            'form' => $form,
            'taxparent' => $this->getModel()->findAll(),
            'taxonomy' => $paginator,
            'taxcount' => $paginator->getPageCount()
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
        $paginator = $this->getModel()->getPaginator($page, (int) 19, 3);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $this->getRequest()->getPost()->tax["slug"] == null ? $tax->setSlug($this->getRequest()->getPost()->tax["name"]) : '';
                $this->getModel()->save($tax);
                $this->redirect()->toRoute('post/post_category');
            }
        }

        return new ViewModel([
            'form' => $form,
            'taxid' => $this->getId(),
            'taxonomy' => $paginator,
            'taxparent' => $this->getModel()->findAll(),
            'taxcount' => $paginator->getPageCount()
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
        $id = $this->getRequest()->isPost() ? $this->getRequest()->getPost()->tax['id'] : (int) $this->params('id', null);
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
