<?php
/*!
 * Copyright 2016 Everex https://everex.io
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// Allow cross-domain ajax requests
header('Access-Control-Allow-Origin: *');

require dirname(__FILE__) . '/../service/lib/ethplorer.php';

$es = Ethplorer::db(require_once dirname(__FILE__) . '/../service/config.php');

$command = isset($_GET["cmd"]) ? $_GET["cmd"] : false;

$result = array();

if($command){
    switch($command){
        case 'last':
            $options = array(
                'limit'     => isset($_GET["limit"])     ? (int)$_GET["limit"]     : 10,
                'timestamp' => isset($_GET["timestamp"]) ? (int)$_GET["timestamp"] : 0,
            );
            $result = $es->getLastTransfers($options);
            break;
        default:
            $result['error']    = true;
            $result['message']  = 'Unknown command';
    }
    echo json_encode($result);
}