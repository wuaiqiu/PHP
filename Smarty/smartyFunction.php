<?php
/*
 * 内置函数
 *   (1)foreach,foreachelse:循环
 *      <{foreach from=$arr key=key item=value}>
 *          {$key}-->{$value}
 *      <{/foreach}>
 *      
 *   (2)include：包含文件
 *      <{include file="base.html" arg1="value1" arg2="value2"}>
 *      
 *   (3)if语句（eq、ne、neq、gt、lt、lte、le、gte、ge、is even、is odd、is not even、
 *   is not odd、not、mod、div by、even by、odd by、==、!=、>、<、<=、>=.）
 *   
 *     <{if $name eq "Fred"}>
 *          Welcome Sir.
 *     <{elseif $name eq "Wilma"}>
 *          Welcome Ma'am.
 *     <{else}>
 *          Welcome, whatever you are.
 *     <{/if}>
 *     
 *   (4)literal忽略解析的区域（如JavaScript脚本）
 *         <{literal}>
 *                  ..
 *         <{/literal}>
 *         
 *   (5)section：循环
 *     $people = array('tony','sweety','abc','four');
 *     <{section name=n loop=$people}>
 *          name:{$people[n]}<br/>
 *     <{/section}>
 *     
 *     <{section name=sn loop=$news}>
 *          <{if $smarty.section.sn.first}>
 *              <table>
 *                  <th>title</th>
 *          <{/if}>
 *          <tr>
 *              <td>{$news[sn]}</td>
 *          </tr>
 *      <{if $smarty.section.sn.last}>
 *          </table>
 *      {/if}
 *      <{sectionelse}>
 *          there is no news.
 *      <{/section}>
 * */