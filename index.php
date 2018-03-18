<?php
$arr = array(
    array( 'text' => 'Текст красного цвета'
    , 'cells' => '1,2,4,5'
    , 'align' => 'center'
    , 'valign' => 'center'
    , 'color' => 'FF0000'
    , 'bgcolor' => '0000FF')
, array( 'text' => 'Текст зеленого цвета'
    , 'cells' => '8,9'
    , 'align' => 'center'
    , 'valign' => 'center'
    , 'color' => '00FF00'
    , 'bgcolor' => 'FFFFFF')

);

function gentable($arg = array()){
    foreach ($arg as $item){
        $item['cells'] = explode(',' ,$item['cells']);

//Создаем массив с заданными ячейками
        foreach ($item['cells'] as $item){
            $arr_cells[] =  $item;
        }

    }


//Проверяем была ли заданая ячейка, если нет добавляем в массив новую пустую яейку
    for($i=1;$i<=9;$i++){
        if(!in_array($i, $arr_cells)){

            array_push($arg, array( 'text' =>  $i
            , 'cells' => array($i)
            , 'align' => 'center'
            , 'valign' => 'center'
            , 'color' => ''
            , 'bgcolor' => ''));
        }

    }

    //Преназначаяем ключ согласно номеру ячейки, и сортируем массив
    foreach ($arg as $item) {
        $new_key = $item['cells'][0];
        $rrr[$new_key] = $item;
        ksort($rrr);
    }
//генерируем таблицу
    $table="";
    for ($i=1;$i<=9;$i++){
        if (isset($rrr[$i])){
            if ($i==1||$i==4||$i==7){
                $table .= "<tr>";
            }
            if(!is_array($rrr[$i]["cells"])){

                $cells= explode(',' ,$rrr[$i]["cells"]);
                //Определяем строку минимального значения
                if(is_int(min($cells)/3)){
                    $row_min =  min($cells)/3;
                }else{
                    $row_min =  (int)(min($cells)/3)+1;
                }

                //Определяем строку максимального значения
                if(is_int(max($cells)/3)){

                    $row_max =  max($cells)/3;

                }else{
                    $row_max =  (int)(max($cells)/3)+1;
                }

                //Определяем колонку минимального значения
                $col_min =  min($cells)- $row_min*3;

                //Определяем колонку максимального значения
                $col_max =  max($cells)- $row_max*3;

                $rowspan = $row_max - $row_min+1 ;
                $colspan = $col_max - $col_min+1;
            }else{
                $rowspan =1;
                $colspan=1;
            }
            $table .= "<td
                        height='".($rowspan*50)."'px;
                        width = '".($colspan*50)."px'
                        rowspan='$rowspan'
                        colspan='$colspan'
                        align= '".$rrr[$i]["align"]."'  
                        valign= '".$rrr[$i]["valign"]."'   
                        style=' 
                                background-color: #".$rrr[$i]["bgcolor"]."; 
                                color: #".$rrr[$i]["color"]."; 
                    '>".$rrr[$i]["text"]."</td>";
            if ($i==3||$i==6||$i==9){
                $table .= "</tr>";
            }
        }
    }

    echo $table;


};

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
        td {
            padding: 5px; /* Поля вокруг текста */
            border: 1px solid #004085; /* Рамка вокруг ячеек */
        }
    </style>
    <title>Document</title>
</head>
<body>
<table>
    <?=gentable($arr);?>
</table>
</>
</html>