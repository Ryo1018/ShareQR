<?php
// session_start();

// 読み込むファイル名
$fileToRead = 'tmp.txt';

// ファイルを開いて読み込みモードでオープン
$file = fopen($fileToRead, 'r');

if ($file) {
    // ファイルからデータを読み込む
    $line = fgets($file);

    // ファイルを閉じる
    fclose($file);

    if ($line !== false) {
        // 読み込んだ1行のデータを表示
        echo "ファイルの1行目: " . $line;
    } else {
        echo "ファイルの終わりに達しました。";
    }
} else {
    echo "ファイルを開けませんでした。";
}


if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $file_path = __DIR__ . '/sharing_file/' . $file;

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        readfile($file_path);
    } else {
        echo "ファイルが存在しません。";
    }
} else {
    echo "ファイルが指定されていません。";
}
?>

