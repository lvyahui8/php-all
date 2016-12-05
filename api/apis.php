<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/12/5
 * Time: 13:30
 */
return array(
    array(
        'name'  =>  '用户删除',
        'url'   =>  '/user/delete/{user_id}',
        'explain'   =>  '删除用户，必须是已登录的管理员才有权限发起请求',
        'request_type'  =>  'GET',
        'param_type'    =>  'PathParam',
        'params'     =>  array(
            'id'  => array(
                'name'  =>  '用户名',
                'mark'  =>  '备注',
                'required'  =>  true,
            )
        ),
        'resp_type' =>  'application/json',
        'success_resp'  =>  'code',
        'error_resp'    =>  'code',
    )
);
