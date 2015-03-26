<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_default_index")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * addAction
     *
     * Description
     *
     * @Route("/add/", name="app_default_add")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction()
    {
        return $this->render(
            ':default:form.html.twig',
            [
                'title'     => 'Add',
                'action'    => $this->generateUrl('app_default_doAdd'),
                'button'    => 'Add',
            ]
        );
    }

    /**
     * doAddAction
     *
     * Description
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/do-add/", name="app_default_doAdd")
     */
    public function doAddAction(Request $request)
    {
        $calculator = $this->get('app.service.calculator');
        $op1 = $request->request->get('op1');
        $op2 = $request->request->get('op2');
        $calculator->setOp1($op1);
        $calculator->setOp2($op2);
        $calculator->add();
        $result = $calculator->getResult();

        return $this->render(
            ':default:result.html.twig',
            [
                'op1'       => $op1,
                'op2'       => $op2,
                'result'    => $result,
                'title'     => 'Add Result',
            ]
        );
    }
}
