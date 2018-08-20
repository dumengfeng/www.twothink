<?php
ob_start();
    $Content = '小区通知';
    $request = file_get_contents('php://input');
    $xml = simplexml_load_string($request);
    $data = [];
    foreach ($xml as $key => $value) {
        $data[$key] = (string)$value;
    }
    extract($data);
    $city = simplexml_load_file('http://flash.weather.com.cn/wmaps/xml/sichuan.xml');
    foreach ($city as $val) {
        if ($Content == (string)$val['cityname']) {
            $Content = $val['cityname'] . ":天气" . $val['stateDetailed'] . ",最高温度" . $val['tem2'] . "度,最低温度" . $val['tem1'] . "度,当前气温" . $val['temNow'] . "度,强度" . $val['windState'] . ",风向" . $val['windDir'] . ",风力" . $val['windPower'];
        }
    }
    $Time = time();
    if ($Content == "小区通知") {
        $link = @mysqli_connect('127.0.0.1','root','root','twothink',3306) or die('数据库连接失败');
        $re = mysqli_query($link,"select d.title,d.description,p.path,d.id from `twothink_document` as d join `twothink_picture` as p on p.id=d.cover_id where d.category_id=43 and d.status=1 ORDER BY d.create_time DESC limit 0,8");
        $news = mysqli_fetch_all($re,1);
        require 'news.xml';
    }
    require 'tianqi.xml';
    $c = ob_get_contents();
    file_put_contents('ese.xml',$c);
