<?php
// ライブラリ読み込み
require_once "phpqrcode/qrlib.php";
session_start();

// 画像の保存場所
$filepath = 'qr.png';

$networkaddress = $_SESSION['ip'];
// QRコードの内容
$contents = "http://".$networkaddress.":8888/download.php?file=".$_SESSION['url'];
$_SESSION['qr'] = $contents;
// QRコード画像を出力
QRcode::png($contents, $filepath, QR_ECLEVEL_M, 6);

//このファイルを画像ファイルとして扱う宣言
header('Content-Type: image/png');
readfile('qr.png');
?>
