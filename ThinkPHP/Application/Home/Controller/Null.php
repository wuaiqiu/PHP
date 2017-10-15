<?php
/*
 *空操作与空控制器
 *      
 *          a.空操作指的是控制器中没有的操作
 *              public function _empty(){
 *                  echo "没有".ACTION_NAME;
 *              }
 *          
 *              
 *          b.空控制器
 *              class EmptyController extends Controller{
 *                  function index(){
 *                      echo "没有".CONTROLLER_NAME;
 *                   }
 *               }      
 * */