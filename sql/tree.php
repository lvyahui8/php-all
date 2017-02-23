<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2017/2/23
 * Time: 16:44
 */

$forest = array(
    array(
        'name'  =>  'A',
        'num'   =>  10,
        'childs' => array(
            array(
                'name' => 'B',
                'num'   =>  7,
                'childs' => array()
            ),
            array(
                'name' => 'C',
                'num'   =>  3,
                'childs' => array(
                    array(
                        'name' => 'D',
                        'num'   =>  1,
                        'childs' => array()
                    ),
                    array(
                        'name' => 'E',
                        'num'   =>  2,
                        'childs' => array()
                    )
                )
            )
        )
    ),
    array(
        'name' => 'F',
        'num'   =>  2,
        'childs' => array(
            array(
                'name' => 'G',
                'num'   =>  2,
                'childs' => array()
            )
        )
    )
);

function pre_order(& $forset,$level){
    static $i = 1;
    static $tree_id = 1;
    foreach($forset as & $node){
        $node['lft'] = $i ++ ;
        if(!empty($node['childs'])){
            pre_order($node['childs'],$level + 1);
        }
        $node['rgt'] = $i ++ ;
        echo "{$node['lft']} | {$node['name']} | {$node['rgt']} \n";
        //echo "insert into node3 (tree_id, name, num, lft, rgt, level) VALUE ($tree_id,'{$node['name']}',{$node['num']},{$node['lft']},{$node['rgt']},$level); \n";
        if($node['lft'] === 1){
            // 遍历新的树
            $i = 1;
            $tree_id ++;
        }
    }
}

pre_order($forest,1);
