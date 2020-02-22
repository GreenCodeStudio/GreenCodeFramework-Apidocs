<?php

namespace ApiDocs\Controllers;

use Common\PageStandardController;

class ApiDocs extends PageStandardController
{

    function index()
    {
        $this->addView('ApiDocs', 'start');
    }

    function definition()
    {
        $obj = new (\ApiDocs\ApiDocs())->GetDefinition();
        $obj['info']['title'] = $this->getPageHeader();
        echo json_encode($obj);
        exit;
    }
}
