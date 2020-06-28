<?php


namespace ApiDocs;


use Core\Routing\RouterOld;

class ApiDocs
{
    public function GetDefinition()
    {
        $obj = ['openapi' => '3.0.0'];
        $obj['servers'][]['url'] = '/api';
        $controllers = RouterOld::listControllers('Api');
        foreach ($controllers as $controller) {
            //dump($controller);
            foreach ($controller->methods as $method) {
                foreach ($method->annotations as $annotation) {
                    if ($annotation instanceof \ApiEndpointAnnotation) {

                        $obj['paths']['/'.trim($annotation->url, ' /')][$annotation->type] = ['summary' => $method->name, 'responses' => [

                        ]];

                    }
                }
            }
        }
        return $obj;
    }
}