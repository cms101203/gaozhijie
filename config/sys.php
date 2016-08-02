<?php

return [

    //登录处理用哪个处理器来处理
    'login_process' => 'default',
    //图片的域名，必须以http://开头
    'sys_images_domain' => 'http://images.tests.com',
    //后台访问域名，不用http://开头
    'sys_admin_domain' => 'admin.tests.com',
    //前台访问域名
    'sys_blog_domain' => 'tests.com',
    //博客访问域名无前缀
    'sys_blog_nopre_domain' => 'opcache.net',
    //不需要验证权限的功能，*号代表全部,module不能为*号
//    'access_public' => [
//        ['module' => 'foundation', 'class' => 'index', 'function' => '*'],
//        ['module' => 'foundation', 'class' => 'user', 'function' => ['mpassword']],
//        ['module' => 'foundation', 'class' => 'upload', 'function' => ['process']],
//    ]
];
