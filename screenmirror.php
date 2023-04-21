<!DOCTYPE html><html><head><meta charset="utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><title>Widget Engine</title>
<?php
$phoneIp = $_GET['ip'];
if(empty($phoneIp)) {
    $phoneIp = rtrim(shell_exec('netstat -rn | head -n 3 | tail -n 1 | cut -d " " -f 10'), "\n");
}
if(!empty($_GET['dev'])) {
    include_once __DIR__ . '/fakeSMEG.php';
}
?>
<style>
body {
    height: 434px;
    margin: 46px 0 0 0;
    position:relative;
    <?=empty($_GET['dev']) ? '' : 'background-image: url("SMEGbackground.jpg");'?>
    background-color:#000000;
    color:#FFFFFF;
}
.middle-mirror {
    margin-top: 10px;
    margin-left: 70px;
}
.top-mirror {
    margin-top: 30px;
    margin-bottom: 10px;
}
.battery-mirror {
    width: 15%;
}
</style>
</head>
<body>
    <div style="float:left; max-width:430px; margin-right: 5px;">
        <img id="middle-mirror" class="middle-mirror" onload="middleUpdate()" onerror="setTimeout(middleUpdate, 5000)" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($phoneIp) ? "" : "ip=".$phoneIp."&"?>part=m">
    </div>
    
    <img id="top-mirror" class="top-mirror" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?>part=t">
    <br>
    <img id="bottom-mirror" class="bottom-mirror" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?>part=b">
    <br>
    <img id="battery-mirror" class="battery-mirror" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?>part=batt">

    <div style="position:absolute;right:100px;top:220px" id="fps">asd</div>
    <div style="position:absolute;right:100px;top:260px"><b><div id="autonomy">-1</div><div>km</div></b></div>

    <div style="position:absolute;right:16px;top:330px"><a href="index.html" onclick="document.body.style.marginTop='-1000px'"><img src="back.png" style="width:74px"/></a></div>
</body>
<script>


    function middleUpdate() {
        document.getElementById("fps").innerHTML = new Date().getTime() - document.getElementById("middle-mirror").src.split("=m&")[1];
        document.getElementById("middle-mirror").src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($phoneIp) ? "" : "ip=".$phoneIp."&"?>part=m&" + new Date().getTime();
        
    }

    (function(){
            var D = document, P = /complete|loaded|interactive/,
            onready = function(a) {
                P.test(D.readyState) ? a() : D.addEventListener("DOMContentLoaded", function () {
                    a()
                }, !1);
            },
            topmirror = document.getElementById("top-mirror");
            bottommirror = document.getElementById("bottom-mirror");
            batterymirror = document.getElementById("battery-mirror");
            autonomyElement = document.getElementById("autonomy");

            updateBottom = function() {
                bottommirror.src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($phoneIp) ? "" : "ip=".$phoneIp."&"?>part=b&" + new Date().getTime();
                setTimeout(updateBottom, 31000);
            },

            updateTop = function() {
                topmirror.src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($phoneIp) ? "" : "ip=".$phoneIp."&"?>part=t&" + new Date().getTime();
                setTimeout(updateTop, 5000);
            },

            updateAutonomy = function() {
                autonomyElement.innerHTML = top.GetCar.Autonomy();
                setTimeout(updateAutonomy, 1500);
            }

            updateBattery = function() {
                batterymirror.src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($phoneIp) ? "" : "ip=".$phoneIp."&"?>part=batt&" + new Date().getTime();
                setTimeout(updateBattery, 30000);
            }

            mainFunction = function() {
                setTimeout(updateTop, 1000);
                setTimeout(updateBottom, 1000);
                setTimeout(updateAutonomy, 1000);
                setTimeout(updateBattery, 1000);
            }

            onready(mainFunction);
    })();
</script>
</html>
