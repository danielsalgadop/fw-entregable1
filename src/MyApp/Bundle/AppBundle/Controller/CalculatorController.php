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
    public $calc = null;
    public $validator = null;
    public $request = null;
    public function __construct()
    {
        $this->calc = new Calculator;
        $this->validator = new Validator;
        $this->request = Request::createFromGlobals();
    }

    public function addAction($param1, $param2): Response
    {
        if (! $this->validator->areNumbers(func_get_args())) {
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->add($param1, $param2));
    }

    public function substractAction(): Response
    {
        $param1 = $this->request->get('param1');
        $param2 = $this->request->get('param2');
        if (! $this->validator->areNumbers([$param1,$param2])) {
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->substract($param1, $param2));
    }

    public function timesAction($param1): Response
    {
        $param2 = $this->findParam2();

        if (! $this->validator->areNumbers([$param1,$param2])) {
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->times($param1, $param2));
    }

    /**
     * @Route("/divide/{param1}/{param2}/", name="calculator_divide", requirements={"param1" = "-*\d+", "param2" = "-*\d+"})
     */
    public function divideAction($param1, $param2): Response
    {
        if ($param2 == 0) {
            return $this->render('default/error_406.html.twig', [
                'message' => "divide by 0",
            ]);
        }
        if (! $this->validator->areNumbers(func_get_args())) {
            return $this->invalidParams();
        }
        return new Response((int)$this->calc->divide($param1, $param2));
    }
    private function invalidParams()
    {
        return $this->render('default/error_406.html.twig', [
            'message' => self::ERROR_INVALID_PARAMS,
        ]);
    }

    public function errorAction(): Response
    {
        return $this->invalidParams();
    }

    private function findParam2(): int
    {
        if ($this->request->request->get('param2')) {
            return $this->request->request->get('param2');
        } elseif ($this->request->query->get('param2')) {
            return $this->request->query->get('param2');
        }
    }
}
