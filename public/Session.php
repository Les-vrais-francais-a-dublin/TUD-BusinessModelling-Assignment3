<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;

use Luthor\Response\HttpResponse;

class view_interface
{
    private $_args;
    private $_request;
    private $_response;
    private $_handler;
    private $_session;

    // Construct an interface to controller action, params and identity to perfom actions
    public function __construct($request, $response, $handler)
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->_handler = $handler;
    }
    // Init all elements needed to identify somebody
    public function init()
    {
        if (!$this->initQueryParams())
            return (new HttpResponse(array(), "Incorect params", 401));
        return (True);
    }
    // getting the query param of the request
    private function initQueryParams()
    {
        $this->_args["query_params"] = $this->_request->getQueryParams();
        return (True);
    }
    // call the action
    public function getResponse()
    {
        $function = $this->_handler;
        $response = call_user_func($this->_handler, $this->_args);
        return ($response);
    }
    /**
     * Get the value of _args
     *
     * @return  mixed
     */
    public function get_args()
    {
        return $this->_args;
    }
    /**
     * Set the value of _args
     *
     * @param   mixed  $_args  
     *
     * @return  self
     */
    public function set_args($_args)
    {
        $this->_args = $_args;
        return $this;
    }
}

// function to redirect the request to the good action and perform the identity verification
function router(ServerRequestInterface $request, ResponseInterface $response, $function)
{
    $interface = new view_interface($request, $response, $function);
    $checking = $interface->init();
    if (gettype($checking) == "object") {
        $res = $checking;
    } else {
        $res = $interface->getResponse();
    }
    $res_final = $res->getResponse($response);

    return $res_final;
}
