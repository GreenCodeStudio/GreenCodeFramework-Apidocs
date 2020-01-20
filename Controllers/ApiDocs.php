<?php

namespace ApiDocs\Controllers;

use Core\Router;

class ApiDocs extends \Common\PageStandardController
{

    function index()
    {
        $this->addView('ApiDocs', 'start');
    }
    function definition(){

        $obj=['openapi'=>'3.0.0'];
        $obj['info']['title']=$this->getPageHeader();
        $obj['servers'][]['url']='/api';
        $controllers=Router::listControllers('Api');
        foreach ($controllers as $controller){
            //dump($controller);
            foreach($controller->methods as $method){
                foreach ($method->annotations as $annotation) {
                    if ($annotation instanceof \ApiEndpointAnnotation) {

                        $obj['paths']['/'.trim($annotation->url,' /')][$annotation->type]=['summary'=>$method->name, 'responses'=>[

                        ]];

                    }
                }
            }
        }
        echo json_encode($obj);exit;
    }
}
