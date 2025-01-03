<?php


namespace ApiDocs;


use Core\Routing\ApiRouter;

class ApiDocs
{
    public function GetDefinition()
    {
        $obj = ['openapi' => '3.0.0'];
        $obj['servers'][0]['url'] = '/api';
        $obj['security'][] = ["api_key"];
        $obj['components']['securitySchemes']['apiKey'] = [
            "type" => "http",
            "scheme" => "Bearer"
        ];
        $controllers = (new ApiRouter())->listControllers();
        foreach ($controllers as $controller) {
            //dump($controller);
            foreach ($controller->methods as $method) {
                foreach ($method->annotations as $annotation) {
                    if ($annotation instanceof \ApiEndpointAnnotation) {
                        $obj['paths']['/'.trim($annotation->url, ' /')][$annotation->type] = ['security' => $annotation->allowNotLogged ? [] : [['apiKey' => []]], 'summary' => $method->name, 'responses' => $annotation->responses, 'parameters' => $annotation->parameters, 'description' => $annotation->description, 'tags' => $annotation->tags ?? []];
                        if ($annotation->requestBody) {
                            $obj['paths']['/'.trim($annotation->url, ' /')][$annotation->type]['requestBody'] = $annotation->requestBody;
                        }
                    }
                }
            }
        }
        return $obj;
    }
}