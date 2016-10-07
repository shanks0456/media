<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>乗換駅表示</title>

<script type="text/javascript"><!--
var xml = {};

function StationGroup(code){
if (code==0){
document.getElementById("s_group").innerHTML = "";
} else {
var s = document.getElementsByTagName("head")[0].appendChild(document.createElement("script"));
s.type = "text/javascript";
s.charset = "utf-8";
s.src = "http://www.ekidata.jp/api/g/" + code + ".json";	//駅グループJSONデータURL

var str = "";
xml.onload = function(data){
var station_g = data["station_g"];
if(station_g != null){
for( i=0; i<station_g.length; i++){
str = str + station_g[i].line_name + " ";
str = str + station_g[i].station_name + "<br />";
}
}
document.getElementById("s_group").innerHTML = str;
}
}
}

// --></script>
</head>
<body>
乗換駅表示<br>	
<a href="#" OnClick="StationGroup(1110315)">札幌駅</a> | 
<a href="#" OnClick="StationGroup(1130208)">新宿駅</a> | 
<a href="#" OnClick="StationGroup(3000136)">名古屋駅</a> | 
<a href="#" OnClick="StationGroup(2800213)">赤坂見附駅</a> | 
<a href="#" OnClick="StationGroup(0)">クリア</a><br />
<div id="s_group"></div>
</body>
</html>