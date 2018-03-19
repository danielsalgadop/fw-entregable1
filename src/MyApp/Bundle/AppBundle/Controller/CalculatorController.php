<?php

namespace MyApp\Bundle\AppBundle\Controller;

use MyApp\Component\Calculator\Calculator;
use MyApp\Component\Validator\Validator;
// use Symfony\Component\HttpKernel\Exception\HttpException;  # no entiendo qué aporta


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CalculatorController extends Controller
{
    const ERROR_INVALID_PARAMS = "parametros no validos";
    var $calc = null;
    var $validator = null;
    var $request = null;
    # public function __construct($param1=0,$param2=0)  # asi no llegan los parametros. Debe ser que symfony instancia esto sin los valores que llegan en la request
    public function __construct()
    {
        $this->calc = new Calculator;
        $this->validator = new Validator;
        $this->request = Request::createFromGlobals();
    }

    public function addAction($param1,$param2)
    {
        if(! $this->validator->areNumbers(func_get_args())){
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->add($param1,$param2));
        // return new Response(new HttpException(406,"parametros no validos"));
    }

    public function substractAction()
    {
        $param1 = $this->request->get('param1');
        $param2 = $this->request->get('param2');
        if(! $this->validator->areNumbers([$param1,$param2])){
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->substract($param1,$param2));
    }

    public function timesAction($param1,$param2)
    {
        $param2 = $this->request->query->get('param2');
        if(! $this->validator->areNumbers([$param1,$param2])){
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->times($param1,$param2));
    }

    /**
     * @Route("/divide/{param1}/{param2}/", name="calculator_divide", requirements={"param1" = "-*\d+", "param2" = "-*\d+"})
     */
    public function divideAction($param1,$param2)
    {

        if($param2 == 0){
            return $this->render('default/error_406.html.twig', [
                'message' => "divide by 0",
            ]);
            // return new Response(new HttpException(406,"divide by 0"));
        }
        if(! $this->validator->areNumbers(func_get_args())){
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->divide($param1,$param2));
    }
    private function invalidParams()
    {
        return $this->render('default/error_406.html.twig', [
            'message' => self::ERROR_INVALID_PARAMS,
        ]);
    }

    public function errorAction(){
        return $this->invalidParams();
    }
}