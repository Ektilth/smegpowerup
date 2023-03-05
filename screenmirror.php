<!DOCTYPE html><html><head><meta charset="utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><title>Widget Engine</title>
<?php
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
    border-radius: 5px;
}
.top-mirror {
    margin-top: 30px;
    margin-bottom: 10px;
}
.bottom-mirror {
    border-radius: 5px;
}
</style>
</head>
<body>
    <div style="float:left; max-width:430px; margin-right: 5px;">
        <img id="middle-mirror" class="middle-mirror" onload="middleUpdate()" onerror="setTimeout(middleUpdate, 5000)" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($_GET['ip']) ? "" : "ip=".$_GET['ip']."&"?>part=m">
    </div>
    
    <img id="top-mirror" class="top-mirror" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?>part=t">
    <br>
    <img id="bottom-mirror" class="bottom-mirror" src="mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?>part=b">

    <div style="position:absolute;right:100px;top:260px" id="fps">asd</div>

    <div style="position:absolute;right:16px;top:330px"><a href="index.html" onclick="document.body.style.marginTop='-1000px'"><img src="back.png" style="width:74px"/></a></div>
</body>
<script>


    function middleUpdate() {
        document.getElementById("fps").innerHTML = new Date().getTime() - document.getElementById("middle-mirror").src.split("=m&")[1];
        document.getElementById("middle-mirror").src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($_GET['ip']) ? "" : "ip=".$_GET['ip']."&"?>part=m&" + new Date().getTime();
        
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

            updateBottom = function() {
                bottommirror.src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($_GET['ip']) ? "" : "ip=".$_GET['ip']."&"?>part=b&" + new Date().getTime();
                setTimeout(updateBottom, 5000);
            },

            updateTop = function() {
                topmirror.src = "mirror.php?<?=empty($_GET['dev']) ? "" : "dev=1&"?><?=empty($_GET['ip']) ? "" : "ip=".$_GET['ip']."&"?>part=t&" + new Date().getTime();
                setTimeout(updateTop, 5000);
            },

            mainFunction = function() {
                setTimeout(updateTop, 1000);
                setTimeout(updateBottom, 5000);
            }

            onready(mainFunction);
    })();
</script>
</html>
