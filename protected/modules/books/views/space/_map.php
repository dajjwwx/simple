     <?php  Yii::app()->getClientScript()->registerScriptFile('http://api.map.baidu.com/api?v=1.5&ak=C8618e6cb8fd48c04a02f920e5a23d69');?>
              <!--引用百度地图-->
        <!--
        设计样式
            container容器：占50%大小
        -->
        <style type="text/css">
        #container{
            width:100%;
            height:50%;
        }
        </style>
        <div id="mapContainer"></div>
        <script type="text/javascript">
            var map = new BMap.Map("mapContainer");//在container容器中创建一个地图,参数container为div的id属性;
            var point = new BMap.Point(116.404,39.916);//定位
            map.centerAndZoom(point,15);                //将point移到浏览器中心，并且地图大小调整为15;
             
            <!--以后只需要在此处添加代码即可-->
        </script>