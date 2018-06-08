<?php
if (!function_exists('getallheaders')) {
    function getallheaders()
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

print_r(getallheaders());

$FORM_POST = $_POST;
// 支持raw数据传输
$RAW_POST = json_decode(file_get_contents('php://input'), true);

if ($RAW_POST) {
    $_POST = array_merge($FORM_POST, $RAW_POST);
}

print_r($_POST);

//exit;

//
//$name = $_POST['lesson'];
//echo "hello " . $name;

//$inputJSON = file_get_contents('php://input');
//echo $inputJSON;
//$input     = json_decode($inputJSON, true); //convert JSON into array
//print_r($input);
