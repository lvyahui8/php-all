/**
 * Created by samlv on 2017/2/22.
 */

var defaultParamConfig = {
    is_required : true,
    label   : '',
    type    :   'string'
};

/*
 * application/x-www-form-urlencoded 形式参数
 *
 * /1/sz?name=lyvahui&data={"email":"lvyahui","age":10}
 *
 * 看这种类型的参数中的json我们需不需要深入校验
 */
var reqExam = {
    params : {
        // 参数字段名 -> 参数配置
        path_param_1 : {
            type : 'int',
            label : '省份'
        },
        path_param_2 : {
            type : 'string',
            label : '城市'
        },
        name : {
            is_required : true,
            type : 'int',   // string\json\ip\email等等
            label : '姓名'
        },
        data : {
            is_required : true,
            type : 'json',
            label : '数据'
        }
    },
    content_type : 'application/x-www-form-urlencoded'
};

/*
 * application/json 类型参数
 * {"name":"samlv","data":{"age":22,"email":"samlv@tencent.com"}}
 */

reqExam = {
    params : {
        name :{
            is_required : true,
            type : 'string',
            label : '姓名'
        },
        data : {
            age : {
                is_required : true,
                type : 'int',
                label : '年龄'
            },
            email : {
                is_required : true,
                type : 'email',
                label : '邮箱'
            }
        }
    },
    content_type : 'application/x-www-form-urlencoded'
};



