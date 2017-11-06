<?php
require_once 'SiteRestHandler.php';
$view = "";
if(isset($_GET["view"]))$view = $_GET["view"];
switch($view){
    case "all":
        #处理 /site/list/
        $siteRestHandler = new SiteRestHandler();
        $siteRestHandler->getAllSites();
        break;
        
    case "single":
        #处理 /site/list/id/
        $siteRestHandler = new SiteRestHandler();
        $siteRestHandler->getSite($_GET["id"]);
        break;
}
