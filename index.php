<?php
    session_start();
    $_SESSION = array();

    // tmpを空にする
    $fileToEmpty = 'tmp.txt';
    $file = fopen($fileToEmpty, 'w');
    if ($file) {
        // ファイルを空にする
        ftruncate($file, 0);
        fclose($file);
        //echo "ファイルの中身を空にしました。";
    } else {
        //echo "ファイルを開けませんでした。";
    }

    function emptyFolder($folderPath) {
        if (is_dir($folderPath)) {
            $files = glob($folderPath . '/*');
            
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // ファイルを削除
                } elseif (is_dir($file)) {
                    emptyFolder($file); // サブフォルダを再帰的に空にする
                    rmdir($file); // 空のサブフォルダを削除
                }
            }
        }
    }
    
    // 空にするフォルダのパス
    $folderToEmpty = './sharing_file';
    
    emptyFolder($folderToEmpty);
    
    //echo "フォルダが空にされました。";

    $_ip = 'ip.txt';
    $_file = fopen($_ip, 'r');
    if ($_file) {
        // ファイルからデータを読み込む
        $_SESSION['ip'] = fgets($_file);
    
        // ファイルを閉じる
        fclose($_file);
    } else {
        echo "ファイルを開けませんでした。";
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
    <p>ShareQR</p>
    <form method="POST" action="result.php" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <input type="submit" value="QRコードを表示する">
    </form>
</body>
</html>
