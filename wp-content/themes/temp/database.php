<?php
    //hosweb_management_system
    $DB_host        = 'main-test1-db.cbcxa5lv23yo.ap-northeast-1.rds.amazonaws.com';
    $DB_database    = 'hosweb_management_system';
    $DB_user        = 'admin';
    $DB_password    = 'XdB2atTzPBAtEZrSssXMWnRTuLaKxtJ5';
    // error_reporting(0);
    // $DB_host        = '127.0.0.1';
    // $DB_database    = 'management_system';
    // $DB_user        = 'root';
    // $DB_password    = '';
    $dsn = "mysql:dbname={$DB_database};host={$DB_host}";
    try {
        $pdo = new PDO($dsn, $DB_user, $DB_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // echo "接続に成功しました。<br>";
    } catch (PDOException $e) {
        // echo "接続に失敗しました。{$e->getMessage()}<br>";
    }

    global $shop_id;
    $shop_id = scf::get('店舗ID', 34);
