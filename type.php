<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/23
 * Time: 10:23
 */


$a_bool = true;
$a_str = "foor";
$a_str2 = 'foor';
$an_int = 12;

echo gettype($a_bool);
echo gettype($a_str);

if (is_int($an_int)) {
    $an_int += 4;
}

if (is_string($a_bool)) {
    echo "String : $a_bool";
}

/* Boolean */
$action = '';
$show_separators = true;
if ($action === 'show_version') {
    echo "show version \n";
}

if ($show_separators == true) {
    echo "show sp \n";
}

if ($show_separators) {
    echo "show sp\n";
}

var_dump((bool)"");
var_dump((bool)0);
var_dump((bool)"0");
var_dump((bool)array());
var_dump((bool)new stdClass());//true 在php4.0下不包括任何成员变量的对象（仅 PHP 4.0 适用）为false
var_dump((bool)null);
var_dump((bool)0.0);
var_dump((bool)"false");
var_dump((bool)'false');

print_r(new stdClass());

/* Integer */
$a = 1234;
$a = -123;
$a = 0123;
$a = 0x1A;

$large_number = 2147483647;
var_dump($large_number); // int(2147483647)
$large_number = 2147483648;
var_dump($large_number); // double(2147483648)

/* Doublue 浮点型（也叫浮点数 float，双精度数 double 或实数 real）*/
$a = 1.234;
$b = 1.2e3;
$c = 7E-10;

/*
 * 永远不要相信浮点数结果精确到了最后一位，也永远不要
 * 比较两个浮点数是否相等。如果确实需要更高的精度，应该使用任意精度数学函数或者 gmp 函数。
 * */
$a = 1.23456789;
$b = 1.23456780;

$epsilon = 0.00001;

if (abs($a - $b) < $epsilon) {
    echo "true\n";
}

//echo gmp_com(''.$a,''.$b);

echo 'this is a simple string';
echo 'you can
line
line
';
echo 'Android once said : "I\'ll be back';
echo 'You deleted C:\\*.*?';
echo 'You deleted C:\*.*?';
echo 'This will not expand : \n a newline';
echo 'var do not $expand $editor';
echo "\n";
echo <<<EOD
int main(){
    int n,m;
    while(scanf("%d%d",&n,&m) == 2){
        printf("%.2lf\n",sl(n,m));
    }
    return 0;
}
EOD;

/* 含有变量的更复杂示例 */

class  foo
{
    var $foo;
    var $bar;

    function foo()
    {
        $this->foo = 'Foo';
        $this->bar = array('Bar1', 'Bar2', 'Bar3');
    }
}

$foo = new  foo ();
$name = 'MyName';

echo <<<EOT
My name is " $name ". I am printing some  $foo->foo .
Now, I am printing some  {$foo->bar[1]} .
This should print a capital 'A': \x41
EOT;

echo "hello" . PHP_EOL;
$str = 'abc';

var_dump($str ['1']);
var_dump(isset($str ['1']));

var_dump($str ['1.0']);
var_dump(isset($str ['1.0']));

var_dump($str ['x']);
var_dump(isset($str ['x']));

var_dump($str ['1x']);
var_dump(isset($str ['1x']));


$foo = 1 + "10.5";                 // $foo is float (11.5)
$foo = 1 + "-1.3e3";               // $foo is float (-1299)
$foo = 1 + "bob-1.3e3";            // $foo is integer (1)
$foo = 1 + "bob3";                 // $foo is integer (1)
$foo = 1 + "10 Small Pigs";        // $foo is integer (11)
$foo = 4 + "10.2 Little Piggies";  // $foo is float (14.2)
$foo = "10.0 pigs " + 1;           // $foo is float (11)
$foo = "10.0 pigs " + 1.0;         // $foo is float (11)

echo "\$foo== $foo ; type is " . gettype($foo) . "<br />\n";

/* Array 类型 */
$arr = array(
    'foo' => 'bar',
    'bar' => 'foo',
);

print_r($arr);

$arr = array(
    1    => "a",
    '1'  => 'b',
    1.5  => 'c',
    true => 'd',
);

var_dump($arr);

$array  = array(
    "a" ,
    "b" ,
    6  =>  "c" ,
    "d" ,
);
var_dump ( $array );

$obj  = (object)  'ciao' ;
echo  $obj->scalar ;   // outputs 'ciao'

$binary = (binary) 'string';
print_r($binary);
$binary = b'string';
print_r($binary);
