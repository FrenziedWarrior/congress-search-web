<?php

// function whichMethod($key) {
//     return $methods[$key];
// }

function combineParam($param, $value) {
    return join("=", array($param, $value));
}

$methods = array(
    'leg' => 'legislators?',
    'com' => 'committees?',
    'bill' => 'bills?',
    'amd' => 'amendments?'
);


//$urlHead = "http://congress.api.sunlightfoundation.com/"; // header of url
$urlHead = "https://congress.api.sunlightfoundation.com/";

$apikeyParam = "apikey=f2f1a9b078cb4a41b12596f120841842"; // mandatory, same for all
$perPageParam = combineParam("per_page", "all"); // depending on call to be made
$orderParam = "order";
$chamberParam = "chamber";
$bioguideParam = "bioguide_id";

$urlComponents = array();

if(isset($_GET['method'])) {
    $reqUrl = $urlHead;
    
    switch ($_GET['method']) {
        case "leg":
            $reqUrl .= $methods['leg'];
            $reqUrl .= $apikeyParam;
            
            if(isset($_GET['state'])) {
                // retrieve all legs sorted by state and lastname
                $orderParam = combineParam($orderParam, "state__asc,last_name__asc");
                array_push($urlComponents, $reqUrl, $perPageParam, $orderParam);
                $reqUrl = join("&", $urlComponents);
                $jsonContents = file_get_contents($reqUrl);
//                $jsonContents = file_get_contents("json/legs-all.json");
            }
            
            elseif(isset($_GET['chamber'])) {
                // retrieve required chamber legs sorted by last name
                $chamberParam = combineParam($chamberParam, $_GET['chamber']);
                $orderParam = combineParam($orderParam, "last_name__asc");
                array_push($urlComponents, $reqUrl, $perPageParam, $chamberParam, $orderParam);
                $reqUrl = join("&", $urlComponents);
                
                $jsonContents = file_get_contents($reqUrl);
//                $jsonContents = file_get_contents("json/leg.json");
                
            }
             
            elseif(isset($_GET['bid'])) {
                /* retrieve personal details, top5 bills, top5 committees
                * if bid is set, need to query API 3 times
                */
                
                $bioguideParam = combineParam($bioguideParam, $_GET['bid']);
                array_push($urlComponents, $reqUrl, $perPageParam, $bioguideParam);
                $reqUrl = join("&", $urlComponents);
                
                $jsonPersonal = file_get_contents($reqUrl);
//                $jsonPersonal = file_get_contents("json/leg.json");
                
                
                $urlComponents = array();
                $sponsorIdParam = combineParam("sponsor_id__in", $_GET['bid']);
                $perPageParam = combineParam("per_page", "5");
                $reqUrl = $urlHead;
                $reqUrl .= "bills?";
                $reqUrl .= $apikeyParam;
                array_push($urlComponents, $reqUrl, $perPageParam, $sponsorIdParam);
                $reqUrl = join("&", $urlComponents);
                
//                $jsonTopBills = file_get_contents("json/bills.json");
                $jsonTopBills = file_get_contents($reqUrl);

                
                $urlComponents = array();
                $memberIdParam = combineParam("member_ids", $_GET['bid']);
                $perPageParam = combineParam("per_page", "5");
                $reqUrl = $urlHead;
                $reqUrl .= "committees?";
                $reqUrl .= $apikeyParam;
                array_push($urlComponents, $reqUrl, $perPageParam, $memberIdParam);
                $reqUrl = join("&", $urlComponents);
//                $jsonTopComs = file_get_contents("json/comm.json");
                $jsonTopComs = file_get_contents($reqUrl);
                $jsonContents = json_encode(array($jsonPersonal, $jsonTopBills, $jsonTopComs));
            }
            break;
            
            
            
        case 'bill':
            // retrieving active bills
            $urlComponents = array();
            $reqUrl .= $methods['bill'];
            $reqUrl .= $apikeyParam;
            $perPageParam = combineParam('per_page', '50');
            $orderParam = combineParam('order', 'introduced_on');
            $historyParam = combineParam("history.active", 'true');
            $pdfExists = combineParam('last_version.urls.pdf__exists', 'true');
            array_push($urlComponents, $reqUrl, $perPageParam, $historyParam, $orderParam, $pdfExists);
            $reqUrl = join("&", $urlComponents);
            $jsonA = file_get_contents($reqUrl);

            // retrieving new bills
            $urlComponents = array();
            $historyParam = combineParam("history.active", 'false');
            array_push($urlComponents, $reqUrl, $perPageParam, $historyParam, $orderParam, $pdfExists);
            $reqUrl = join("&", $urlComponents);
            $jsonN = file_get_contents($reqUrl);
            $jsonContents = json_encode(array($jsonA, $jsonN));
            break;


        case 'com':
            // retrieving committees
            $reqUrl .= $methods['com'];
            $reqUrl .= $apikeyParam;
            
            $urlComponents = array();
            array_push($urlComponents, $reqUrl, $perPageParam);
            $reqUrl = join("&", $urlComponents);
            $jsonContents = file_get_contents($reqUrl);
            break;
    }
    
}

echo $jsonContents;
?>