<?php
require (__DIR__ . "/../../vendor/autoload.php");
require (__DIR__ . "/ExampleConfig.php");

use Aliyun\OTS\OTSClient as OTSClient;
use Aliyun\OTS\ColumnTypeConst;
use Aliyun\OTS\RowExistenceExpectationConst;

$otsClient = new OTSClient (array (
    'EndPoint' => EXAMPLE_END_POINT,
    'AccessKeyID' => EXAMPLE_ACCESS_KEY_ID,
    'AccessKeySecret' => EXAMPLE_ACCESS_KEY_SECRET,
    'InstanceName' => EXAMPLE_INSTANCE_NAME
));

// $request = array (
//     'table_meta' => array (
//         'table_name' => 'MyTable', // 表名为 MyTable
//         'primary_key_schema' => array (
//             'PK0' => ColumnTypeConst::CONST_INTEGER, // 第一个主键列（又叫分片键）名称为PK0, 类型为 INTEGER
//             'PK1' => ColumnTypeConst::CONST_STRING
//         ) // 第二个主键列名称为PK1, 类型为STRING

//     ),
//     'reserved_throughput' => array (
//         'capacity_unit' => array (
//             'read' => 0, // 预留读写吞吐量设置为：0个读CU，和0个写CU
//             'write' => 0
//         )
//     )
// );
// $otsClient->createTable ($request);
// sleep (10);

// $request = array (
//     'table_name' => 'MyTable',
//     'condition' => RowExistenceExpectationConst::CONST_IGNORE, // condition可以为IGNORE, EXPECT_EXIST, EXPECT_NOT_EXIST
//     'primary_key' => array ( // 主键
//         'PK0' => 123,
//         'PK1' => 'abc'
//     ),
//     'attribute_columns' => array ( // 属性
//         'attr0' => 456, // INTEGER类型
//         'attr1' => 'Hangzhou', // STRING类型
//         'attr2' => 3.14, // DOUBLE类型
//         'attr3' => true, // BOOLEAN类型
//         'attr4' => false, // BOOLEAN类型
//         'attr5' => array ( // BINARY类型
//             'type' => 'BINARY',
//             'value' => "a binary string"
//         )
//     )
// );

// $response = $otsClient->putRow ($request);



$request = array (
    'table_name' => 'UserLogs',
    'primary_key' => array ( // 主键
        'uid' => (int)28  ,
        'month' => '201701'
    )
);
$response = $otsClient->getRow ($request);
print_r($response);
exit;

$request = array (
    'table_name' => 'User',
    'primary_key' => array ( // 主键
        'id' => 825255  ,
    )
);
$response = $otsClient->getRow ($request);
print_r($response);
exit;

print json_encode ($response);

/* 样例输出：
{
    "consumed": {
        "capacity_unit": {
            "read": 1,                 // 本次操作消耗了1个读CU
            "write": 0
        }
    },
    "row": {
        "primary_key_columns": {
            "PK0": 123,
            "PK1": "abc"
        },
        "attribute_columns": {
            "attr0": 456,
            "attr1": "Hangzhou",
            "attr2": 3.14,
            "attr3": true,
            "attr4": false,
            "attr5": {                  // 请注意BINARY类型的表示方法
                "type": "BINARY",
                "value": "a binary string"
            }
        }
    }
}

*/

