<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$request = $this->getRequest();
    	
    	$result = array();
    	
    	if ($request->isPost())
    	{
    		try {
	    		$nome = $request->getPost('nome');
	    		$cpf = $request->getPost('cpf');
	    		$salario = $request->getPost('salario');
	    		
	    		// CRUD - Create.
	    		
	    		// Instancia o objeto e alimenta os atributos.
	    		$funcionario = new \Application\Model\Funcionario();
	    		$funcionario->setNome($nome);
	    		$funcionario->setCpf($cpf);
	    		$funcionario->setSalario($salario);
	    		
	    		// Chama o Doctrine.
	    		$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	    		// Doctrine inseri no DB.
	    		$em->persist($funcionario);
	    		// Realiza o commit.
	    		$em->flush();
	    		
	    		$result['msg'] = $nome . ", enviado corretamente!";
    		} catch (Exception $e) {
    			
    		}
    	}
    	
        return new ViewModel($result);
    }
}
