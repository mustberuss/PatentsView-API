<?php
ini_set('memory_limit', '3G');
require_once dirname(__FILE__) . '/../executeQuery.php';
require_once dirname(__FILE__) . '/../ErrorHandler.php';
require_once dirname(__FILE__) . '/../entitySpecs.php';
require_once dirname(__FILE__) . '/../AddEmailDatabase.php';

// Set allows headers on Options requests to keep browsers happy, especially if the browser is using SwaggerUI
$app->options(
   '/api/:endpoint/query',
   function () use ($app) {
       $app->response()->header('Access-Control-Allow-Origin', '*');
       $app->response()->header('Access-Control-Allow-Headers', 'origin, content-type, accept');
       $app->response()->header('Access-Control-Allow-Methods','GET, PUT, POST, DELETE, OPTIONS');  
       $app->response()->header('Access-Control-Expose-Headers','X-Status-Reason');
   }
);

// query/q=<query in json format>[&f=<field in json format>][&o=<options in json format>]

//Add to capture the email info
$app->post(
    '/addemail',
    function () use ($app) {
        $body = $app->request->getBody();
	$bodyJSON = json_decode($body,true);
	    if ($bodyJSON['email'] == null) {
            $app->response->status(400);
	        ErrorHandler::getHandler()->sendError(400, "No email provided");
	    } else {
		$email = $bodyJSON['email'];
            if (strpos($email,"@") === false || strpos($email,".") === false) {
                $app->response->status(400);
                ErrorHandler::getHandler()->sendError(400, "Email is invalid: $email");
            }
        }	

	$addEmailDB = new AddEmailDatabase();
	$addEmailDB->addEmail($email);
    }
);

$app->get(
    '/patents/query',
    function () use ($app) {

        global $PATENT_ENTITY_SPECS;
        global $PATENT_FIELD_SPECS;
        
        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);
        
        $results = executeQuery($PATENT_ENTITY_SPECS, $PATENT_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $PATENT_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/patents/query',
    function () use ($app) {
        global $PATENT_ENTITY_SPECS;
        global $PATENT_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($PATENT_ENTITY_SPECS, $PATENT_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $PATENT_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);

$app->get(
    '/inventors/query',
    function () use ($app) {
        global $INVENTOR_ENTITY_SPECS;
        global $INVENTOR_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($INVENTOR_ENTITY_SPECS, $INVENTOR_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $INVENTOR_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/inventors/query',
    function () use ($app) {
        global $INVENTOR_ENTITY_SPECS;
        global $INVENTOR_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($INVENTOR_ENTITY_SPECS, $INVENTOR_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $INVENTOR_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->get(
    '/assignees/query',
    function () use ($app) {
        global $ASSIGNEE_ENTITY_SPECS;
        global $ASSIGNEE_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($ASSIGNEE_ENTITY_SPECS, $ASSIGNEE_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $ASSIGNEE_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/assignees/query',
    function () use ($app) {
        global $ASSIGNEE_ENTITY_SPECS;
        global $ASSIGNEE_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($ASSIGNEE_ENTITY_SPECS, $ASSIGNEE_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $ASSIGNEE_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->get(
    '/cpc_subsections/query',
    function () use ($app) {
        global $CPC_ENTITY_SPECS;
        global $CPC_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($CPC_ENTITY_SPECS, $CPC_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $CPC_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/cpc_subsections/query',
    function () use ($app) {
        global $CPC_ENTITY_SPECS;
        global $CPC_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($CPC_ENTITY_SPECS, $CPC_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $CPC_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->get(
    '/cpc_groups/query',
    function () use ($app) {
        global $CPC_GROUP_ENTITY_SPECS;
        global $CPC_GROUP_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($CPC_GROUP_ENTITY_SPECS, $CPC_GROUP_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $CPC_GROUP_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/cpc_groups/query',
    function () use ($app) {
        global $CPC_GROUP_ENTITY_SPECS;
        global $CPC_GROUP_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($CPC_GROUP_ENTITY_SPECS, $CPC_GROUP_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $CPC_GROUP_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);




$app->get(
    '/uspc_mainclasses/query',
    function () use ($app) {
        global $USPC_ENTITY_SPECS;
        global $USPC_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($USPC_ENTITY_SPECS, $USPC_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $USPC_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/uspc_mainclasses/query',
    function () use ($app) {
        global $USPC_ENTITY_SPECS;
        global $USPC_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($USPC_ENTITY_SPECS, $USPC_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $USPC_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->get(
    '/nber_subcategories/query',
    function () use ($app) {
        global $NBER_ENTITY_SPECS;
        global $NBER_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($NBER_ENTITY_SPECS, $NBER_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $NBER_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/nber_subcategories/query',
    function () use ($app) {
        global $NBER_ENTITY_SPECS;
        global $NBER_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($NBER_ENTITY_SPECS, $NBER_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $NBER_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->get(
    '/locations/query',
    function () use ($app) {
        global $LOCATION_ENTITY_SPECS;
        global $LOCATION_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckGetParameters($app);

        $results = executeQuery($LOCATION_ENTITY_SPECS, $LOCATION_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $LOCATION_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);


$app->post(
    '/locations/query',
    function () use ($app) {
        global $LOCATION_ENTITY_SPECS;
        global $LOCATION_FIELD_SPECS;

        list($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam) = CheckPostParameters($app);

        $results = executeQuery($LOCATION_ENTITY_SPECS, $LOCATION_FIELD_SPECS, $queryParam, $fieldsParam, $sortParam, $optionsParam);
        $results = FormatResults($formatParam, $results, $LOCATION_ENTITY_SPECS);
        $app->response->setBody($results);
    }
);

$app->get(
  '/',
  function () use ($app) {
      $app->contentType('application/html; charset=utf-8');
      $app->response->redirect('doc.html', 303);
  }
);


function CheckGetParameters($app)
{
// Make sure the 'q' parameter exists.
    if ($app->request->get('q') == null) {
        ErrorHandler::getHandler()->sendError(400, "'q' parameter: missing.", $app->request->get());
    }

    // Convert the query param to json, return error if empty or not valid
    $queryParam = json_decode($app->request->get('q'), true);

    if ($queryParam == null) {
        ErrorHandler::getHandler()->sendError(400, "'q' parameter: not valid json.", $app->request->get());
    }
    // Ensure the query param only has one top-level object
    if (count($queryParam) != 1) {
        ErrorHandler::getHandler()->sendError(400, "'q' parameter: should only have one json object in the top-level dictionary.", $app->request->get());
    }

    // Look for an "f" parameter; it may not exist.
    $fieldsParam = null;
    if ($app->request->get('f') != null) {
        $fieldsParam = json_decode($app->request->get('f'), true);
        if ($fieldsParam == null) {
            ErrorHandler::getHandler()->sendError(400, "'f' parameter: not valid json.", $app->request->get());
        }
    }

    // Look for an "s" parameter; it may not exist.
    $sortParam = null;
    if ($app->request->get('s') != null) {
        $sortParam = json_decode($app->request->get('s'), true);
        if ($sortParam == null) {
            ErrorHandler::getHandler()->sendError(400, "'s' parameter: not valid json.", $app->request->get());
        }
    }

    // Look for an "o" parameter; it may not exist.
    $optionsParam = null;
    if ($app->request->get('o') != null) {
        $optionsParam = json_decode($app->request->get('o'), true);
        if ($optionsParam == null) {
            ErrorHandler::getHandler()->sendError(400, "'o' parameter: not valid json.", $app->request->get());
        }
    }
    

    $formatParam = 'json';
    // Look for a "format" parameter; it may not exist.
    if ($app->request->get('format') != null) {
        if (strtolower($app->request->get('format')) == 'json') {
            $formatParam = 'json';
            $app->contentType('application/json; charset=utf-8');
        }
        elseif (strtolower($app->request->get('format')) == 'xml') {
            $formatParam = 'xml';
            $app->contentType('application/xml; charset=utf-8');
        }
        else
            ErrorHandler::getHandler()->sendError(400, "Invalid option for 'format' parameter: use either 'json' or 'xml'.", $app->request->get());
    }

    return array($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam);
}

function CheckPostParameters($app)
{
    $body = $app->request->getBody();
    $bodyJSON = json_decode($body, true);
    if ($bodyJSON['q'] == null) {
        ErrorHandler::getHandler()->sendError(400, "Body does not contain valid JSON: $body", "Invalid JSON pass: $body");
    }
    //ErrorHandler::getHandler()->sendError(200, $bodyJSON);
    // Make sure the 'q' parameter exists.
    if ($bodyJSON['q'] == null) {
        ErrorHandler::getHandler()->sendError(400, "'q' parameter: missing.", $app->request->get());
    }
    // Convert the query param to json, return error if empty or not valid
    $queryParam = $bodyJSON['q'];
    // Ensure the query param only has one top-level object
    if (count($queryParam) != 1) {
        ErrorHandler::getHandler()->sendError(400, "'q' parameter: should only have one json object in the top-level dictionary.", $app->request->get());
    }

    // Look for an "f" parameter; it may not exist.
    $fieldsParam = null;
    if (array_key_exists('f', $bodyJSON))
        $fieldsParam = $bodyJSON['f'];

    $sortParam = null;
    // Look for an "s" parameter; it may not exist.
    if (array_key_exists('s', $bodyJSON))
        $sortParam = $bodyJSON['s'];

    $optionsParam = null;
    // Look for an "o" parameter; it may not exist.
    if (array_key_exists('o', $bodyJSON))
        $optionsParam = $bodyJSON['o'];

    $formatParam = 'json';
    // Look for a "format" parameter; it may not exist.
    if (array_key_exists('format', $bodyJSON)) {
        if ($bodyJSON['format'] == 'json') {
            $formatParam = 'json';
            $app->contentType('application/json; charset=utf-8');
        }
        elseif ($bodyJSON['format'] == 'xml') {
            $formatParam = 'xml';
            $app->contentType('application/xml; charset=utf-8');
        }
        else
            ErrorHandler::getHandler()->sendError(400, "Invalid option for 'format' parameter: use either 'json' or 'xml'.", $app->request->get());
    }

    return array($queryParam, $fieldsParam, $sortParam, $optionsParam, $formatParam);
}

function FormatResults($formatParam, $results, $entitySpecs)
{
    if (strtolower($formatParam) == 'xml') {
        $xml = new SimpleXMLElement('<root/>');
        $results = array_to_xml($results, $xml, 'XXX', $entitySpecs)->asXML();
        return $results;
    } else
        $results = json_encode($results);return $results;
}

function array_to_xml(array $arr, SimpleXMLElement $xml, $parentTag, $entitySpecs) {
    foreach ($arr as $k => $v) {

        $attrArr = array();
        $kArray = explode(' ',$k);
        $tag = array_shift($kArray);

        if (count($kArray) > 0) {
            foreach($kArray as $attrValue) {
                $attrArr[] = explode('=',$attrValue);
            }
        }

        if (is_array($v)) {
            if (is_numeric($k)) {
                $childTag = substr($parentTag,0,-1); #Stripping last character which is expected to be an 's'. Doing this case we don't find the tag in the entity specs.
                foreach ($entitySpecs as $entity)
                    if ($entity['group_name']==$parentTag)
                        $childTag = $entity['entity_name'];
                $child = $xml->addChild($childTag);
                array_to_xml($v, $child, $tag, $entitySpecs);
            } else {
                $child = $xml->addChild($tag);
                if (isset($attrArr)) {
                    foreach($attrArr as $attrArrV) {
                        $child->addAttribute($attrArrV[0],$attrArrV[1]);
                    }
                }
                array_to_xml($v, $child, $tag, $entitySpecs);
            }
        } else {
            $v = str_replace('&','&amp;',$v);
            $child = $xml->addChild($tag, $v);
            if (isset($attrArr)) {
                foreach($attrArr as $attrArrV) {
                    $child->addAttribute($attrArrV[0],$attrArrV[1]);
                }
            }
        }
    }

    return $xml;
}
