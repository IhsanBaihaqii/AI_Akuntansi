<?php
    session_start();
    ob_start();

    define("TRIAL_DAYS", 7);
    define("USER_FILE", "/data/user.json");
    define("ACCOUNTING_DATA_FILE", "/data/accounting_data.json");

    if (!file_exists(__DIR__ . "/data")){
        mkdir(__DIR__ . "/data", 0755, true)
    }

    function initializeJSONFile(){
        $files = [
            USER_FILE => [ => [
                "uname" => "admin_ihsan",
                "pass" => "ihsan1122",
                "admin" => true,
                "created_at" => date("Y-m-d H:i:s")
            ]],
            ACCOUNTING_DATA_FILE => []
        ];
        foreach($files as $file => $defaultData){
            if(!file_exists($file)){
                file_put_contents($file, json_encode($defaultData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }
    }

    function readJSON($file){
        if(!file_exists($file)){
            return [];
        }
        $data = file_get_contents($file);
        return json_decode($data, true) ?: [];
    }

    function writeJSON($file, $data){
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
    }

    initializeJSONFile();
?>