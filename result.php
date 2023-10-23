<?php
// ライブラリ読み込み
require_once "phpqrcode/qrlib.php";

session_start();
// URLを定数に設定
echo $_POST['fileToUpload'];

$_SESSION['url'] = $_POST['fileToUpload'];
print($_SESSION['url']);

$file = $_FILES['fileToUpload'];
$_SESSION['url'] = $file['name'];
toWriteFileName($file['name']);

// ファイルの情報を表示
echo "File Name: " . $file['name'] . "<br>";
//echo "tmp: " . $file['tmp_name'] . "<br>";
echo "File Size: " . $file['size'] . " bytes<br>";

// ファイルを保存したり、処理したりすることができます
// ここでファイルの処理を行います

$destination = __DIR__ . '/sharing_file/' . $file['name'];

if (move_uploaded_file($file['tmp_name'], $destination)) {
    echo "Status: Success";
} else {
    echo "Status: Failed";
}

function toWriteFileName($i) {
    // 書き込むファイル名
    $fileToWrite = 'tmp.txt';

    // 書き込む内容（ファイル名）
    $content = $i;
    // var_dump($content);

    // ファイルを開いて書き込みモードでオープン
    $text = fopen($fileToWrite, 'w');

    if ($text) {
        // ファイルに書き込み
        fwrite($text, $content);

        // ファイルを閉じる
        fclose($text);

        // echo "ファイル名が書き込まれました。";
    } else {
        // echo "ファイルを開けませんでした。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR</title>
</head>
<body>
    <h2>QR</h2>
    <?php echo '<img src="create_qr.php" />'; ?>
    <br>
    <?php echo "http://".$_SESSION['ip'].":8888/download.php?file=".$_SESSION['url']; ?>
    <br>
    <a href="index.php">back</a>
</body>
</html>