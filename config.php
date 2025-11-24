<?php
    session_start();
    ob_start();

    define("TRIAL_DAYS", 7);
    define("USER_FILE", __DIR__ . "/data/user.json");
    define("ACCOUNTING_DATA_FOLDER", __DIR__ . "/data/accounting");

    if (!file_exists(__DIR__ . "/data")) {
        mkdir(__DIR__ . "/data", 0755, true);
    }
    if (!file_exists(ACCOUNTING_DATA_FOLDER)) {
        mkdir(ACCOUNTING_DATA_FOLDER, 0755, true);
    }

    function initializeJSONFile(){
        $files = [
            USER_FILE => [ "admin_ihsan" => [
                "name" => "Ihsan Baihaqi",
                "pass" => "ihsan1122",
                "admin" => true,
                "created_at" => date("Y-m-d H:i:s")
            ]],
            // ACCOUNTING_DATA_FILE => []
        ];
        foreach($files as $file => $defaultData){
            if(!file_exists($file)){
                file_put_contents($file, json_encode($defaultData, JSON_PRETTY_PRINT));
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
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    function readUser($uname){
        return readJSON(USER_FILE)[$uname] ?? [];
    }

    initializeJSONFile();
?>