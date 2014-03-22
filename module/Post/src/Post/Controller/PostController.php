<?php
namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\DAO\DAOManager;
use Doctrine\ORM\EntityManager;
use ORM\Registry\Registry;
use ORM\Entity\Post;
use Post\Form\PostForm;

class PostController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em            
     * @access protected
     * @return UserController
     */
    protected function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

    /**
     *
     * @return \ORM\DAO\DAOManager
     */
    protected function PostDaoManager()
    {
        return new DAOManager($this->getEntityManager(), 'ORM\Entity\Post');
    }

    /**
     *
     * @return \ORM\Registry\ORMRegistry
     */
    protected function RegisterEntityManager()
    {
        return Registry::set("entityManager", $this->getEntityManager());
    }

    /**
     * 
     * @param unknown $id
     * @return object
     */
    protected function findPostId($id)
    {
        return $this->PostDaoManager()->find($id);
    }
    
   

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $repository = $this->PostDaoManager();
        $posts = $repository->findAll();       
        return new ViewModel([
            'posts' => $posts,           
        ]);
    }

    /**
     *
     * @var \Zend\Mvc\Controller\AbstractController $request
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $this->RegisterEntityManager();
        $post = new Post();
        $form = new PostForm();
        $form->bind($post);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());           
            // $post->setCreateTime(new \DateTime('now'));
            // $post->setUpdateTime(new \DateTime('now'));
            
            if ($form->isValid()) {
                $this->PostDaoManager()->save($post);
                $this->redirect()->toRoute('post');
            }
        }
        return new ViewModel([
            'form' => $form
        ]);
    }
    
    /**
     * 
     * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|\Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $id = $request->isPost() ? $request->getPost()->post["id"] : (int) $this->params('id', null);
        
        if (null === $id) {
            return $this->redirect()->toRoute('post');
        }
        
        $this->RegisterEntityManager();
        $post = $this->findPostId($id);
        
        $form = new PostForm();
        $form->bind($post);
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->PostDaoManager()->save($post);
                $this->redirect()->toRoute("post");
            }
        }
        
        return new ViewModel([
            'form' => $form,
            'post' => $post,
            'id' => $id
        ]);
    }
    
    /**
     * 
     * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>
     */
    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        
        if (null === $id) {
            return $this->redirect()->toRoute('post');
        }
        
        $this->PostDaoManager()->remove($this->findPostId($id));
        $this->redirect()->toRoute('post');
    }
}

