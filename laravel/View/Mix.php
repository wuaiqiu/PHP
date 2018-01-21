<?php
/*
 * Mix
 *
 * 1.过程
 *
 *      (1).package.json 确定依赖
 *      (2).npm install 安装依赖
 *      (3).npm run dev 运行mix（webpack.mix.js）
 *           mix.js('resources/assets/js/app.js', 'public/js')
 *              .sass('resources/assets/sass/app.scss', 'public/css');
 *      npm run dev #运行所有 Mix 任务
 *      npm run production  #运行所有 Mix 任务并减少输出
 *      npm run watch     #持续在终端运行并监听所有相关文件的修改
 *      (4).resources/assets/sass/app.scss ----> public/css
 *      (5).resources/assets/js/app.js ---> public/js
 *      (6).resources/assets/js/components/Example.vue  VUE组件
 *      (7).在app.js注册
 *              Vue.component('example', require('./components/Example.vue'));
 *
 * */