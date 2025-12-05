<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <script></script>
    <style>
    <!--
        img {
            max-width: 100%
            height: auto
        }
    -->
    </style>
</head>
<body>
    <a href="./gal.png"><img src="./gal.png"></a>
    <br>
</body>
</html>

<?php
if ($handle2 = opendir('.')){
    // readdir()の結果をいったん配列[]に入れて後から使う
    while ( false !== ($file_list[] = readdir($handle2))) ;
    // 配列格納したので直後にhandle2をcloseしてよし
    closedir($handle2);


    asort($file_list);


    foreach ($file_list as $file_name){
        if ($file_name != "." && $file_name != ".."){
            //print $file_name;
            echo "<a href=\"$file_name\">$file_name </a>";
            echo "<br />";
        }
    }

    foreach ($file_list as $file_name){

        if (is_dir("$file_name")){
            continue;
        }

        $info = new SplFileInfo("$file_name");
        $ext = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

        if ($ext !== 'JPG' && 
            $ext !== 'jpg' && 
            $ext !== 'PNG' && 
            $ext !== 'png' &&
            $ext !== 'BMP' &&
            $ext !== 'php' &&
            $ext !== 'bmp'){
            continue;
        }

        if ($file_name != "." && $file_name != ".."){
            //print $file_name;

            $aryEXIF = exif_read_data("$file_name");
            if($aryEXIF['DateTimeOriginal']) {
                $strFileDateTime = $aryEXIF['DateTimeOriginal'];
            } else {
                $strFileDateTime='EXIFなし';   
            }
            //echo "<a href=\"$file_name\">$file_name<img src=\"$file_name\" width=\"100%\" height=\"auto\"></a>";
            //echo "<a href=\"back.php?fname=" . "$file_name\"" . ">" . "$file_name" . "（撮影日 $strFileDateTime ）" . "<img src=\"./thm/thm10_$file_name\" width=\"100%\" height=\"auto\"></a>";
            //echo '<a href=' . "$file_name" . '>' . "$file_name" . "（撮影日 $strFileDateTime ）" .  '<img src=' . "$file_name" . ' width="100%" height="auto"></a>';
            echo '<a href="' . "$file_name" . '">' . "$file_name" . "（撮影日 $strFileDateTime ）" .  '<img src="' . "$file_name" . '" width="100%" height="auto"></a>';
            print "<br>";
        }
    }
    // var_dump($file_list);
}

/*
string readdir ([ resource $dir_handle ] )
ディレクトリから次のエントリの名前を返します。 エントリ名はファイルシステム上に格納されている順番で返されます。

パラメータ
dir_handle
opendir() が事前にオープンした ディレクトリハンドルリソース。 ディレクトリハンドルを指定しなかった場合は、 opendir() が最後にオープンしたものを使用します。

返り値
成功した場合にエントリ名、失敗した場合に FALSE を返します。

警告
この関数は論理値 FALSE を返す可能性がありますが、FALSE として評価される値を返す可能性もあります。 詳細については 論理値の セクションを参照してください。この関数の返り値を調べるには ===演算子 を 使用してください。
*/
?>

