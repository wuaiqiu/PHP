<?php

include './Smarty.class.php';

$smarty=new Smarty();
$smarty->assign("title", "标题");
$smarty->assign("content", "Hello World!!");
$smarty->display("index.html");