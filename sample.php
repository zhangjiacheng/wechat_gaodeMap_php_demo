<?php
require_once "jssdk.php";
$jssdk = new JSSDK("your_wechat_app_id", "your_wechat_app_id_secret");
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
  content="initial-scale=1.0, user-scalable=no, width=device-width">
<title>POCs</title>
<link rel="stylesheet"
  href="http://cache.amap.com/lbs/static/main.css?v=1.0" />
<style type="text/css">
body,html,#container {
  height: 100%;
  margin: 0px;
  font: 12px Arial;
}

.info {
  border: solid 1px silver;
}

#tip {
  position: absolute;
  font-size: 12px;
  right: 5px;
  bottom: 20px;
  background-color: #fff;
  padding: 6px;
  border: solid 1px silver;
  border-radius: 3px;
  box-shadow: 3px 4px 3px 0px silver;
}

div.info-top {
  position: relative;
  background: none repeat scroll 0 0 #F9F9F9;
  border-bottom: 1px solid #CCC;
  border-radius: 5px 5px 0 0;
}

div.info-top div {
  display: inline-block;
  color: #333333;
  font-size: 14px;
  font-weight: bold;
  line-height: 31px;
  padding: 0 10px;
}

div.info-top img {
  position: absolute;
  top: 10px;
  right: 10px;
  transition-duration: 0.25s;
}

div.info-top img:hover {
  box-shadow: 0px 0px 5px #000;
}

div.info-middle {
  font-size: 12px;
  padding: 6px;
  line-height: 20px;
}

div.info-bottom {
  height: 0px;
  width: 100%;
  clear: both;
  text-align: center;
}

div.info-bottom img {
  position: relative;
  z-index: 104;
}

span {
  margin-left: 5px;
  font-size: 11px;
}

.info-middle img {
  float: left;
  margin-right: 6px;
}
</style>
</head>

<body>

  <div id="container" tabindex="0"></div>
 
</body>

<script type="text/javascript"
    src="http://webapi.amap.com/maps?v=1.3&key=your_高德地图_id"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   *$jssdk = new JSSDK("yourAppID", "yourAppSecret");
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      "chooseImage",
      "previewImage",
      "uploadImage",
      "downloadImage"
    ]
  });
  wx.ready(function () {
    /*// 在这里调用 API
    document.getElementById("takePhotoBtn").onclick = function(){
       wx.chooseImage({
          count: 1, // 默认9
          sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
          sourceType: ['camera'], // 'album', 'camera'可以指定来源是相册还是相机，默认二者都有
          success: function (res) {
               var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
               alert("Photo localIds: " + localIds);
          }
       });
    }
    */
  });

  var mapObj = new AMap.Map('container', {
      resizeEnable : true,
      zoom : 16,
      zooms : [ 3, 18 ],
      center : [ 112.995226, 28.197095 ]
    });

    var pocs = [ {
      "poc_id" : "0",
      "poc_name" : "长沙市芙蓉区八一路泰天大酒店",
      "poc_address" : "长沙市芙蓉区八一路376号",
      "poc_phone" : "0731-84626768",
      "poc_photo_id" : "",
      "center" : "112.994829, 28.19735"
    }, {
      "poc_id" : "1",
      "poc_name" : "长沙市芙蓉区八一路高原红大酒店",
      "poc_address" : " 长沙市芙蓉区八一路387湖南信息大厦16-26层",
      "poc_phone" : " 0731-82766666",
      "poc_photo_id" : "",
      "center" : "112.994046, 28.19735"
    }, {
      "poc_id" : "2",
      "poc_name" : "雅尊戴斯大酒店",
      "poc_address" : "长沙市芙蓉区八一路298号",
      "poc_phone" : "0731-88091555",
      "poc_photo_id" : "",
      "center" : "112.998176, 28.197804"
    } ];

    //var markers = []; //province见Demo引用的JS文件
    //var infoWindows = [];
    
    function fileSelected() {
      wx.chooseImage({
          count: 1, // 默认9
          sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
          sourceType: ['camera'], // 'album', 'camera'可以指定来源是相册还是相机，默认二者都有
          success: function (res) {
               var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
               //alert("Photo localIds: " + localIds);
               document.getElementById("imageView").src = localIds;
          }
       });
    }
    function uploadFile() {
      
    }

    var _onClick = function(e) {

      closeInfoWindow();
      
      var index = parseInt(e.target.getExtData());
      var title = pocs[index].poc_name
          , content = [];//+ '<span style="font-size:11px;color:#F00;">价格:318</span>'
      
      content
          .push("<img id='imageView' src='http://tpc.googlesyndication.com/simgad/5843493769827749134' width='100' height='66'>地址："
              + pocs[index].poc_address);
      content.push("电话：" + pocs[index].poc_phone);
          
      content.push("<input type='button' onclick='fileSelected()' value='点击拍照'/>");
      content.push("<input type='button' onclick='uploadFile()' value='上传图片' />");  

      var inforWindow = new AMap.InfoWindow({
        isCustom : true, //使用自定义窗体
        content : createInfoWindow(title, content.join("<br/>")),
          offset: new AMap.Pixel(16, -45)//-113, -140
      });
      
      inforWindow.open(mapObj, e.target.getPosition());// 

    }

    //构建自定义信息窗体
    function createInfoWindow(title, content) {
      var info = document.createElement("div");
      info.className = "info";

      //可以通过下面的方式修改自定义窗体的宽高
      //info.style.width = "400px";

      // 定义顶部标题
      var top = document.createElement("div");
      var titleD = document.createElement("div");
      var closeX = document.createElement("img");
      top.className = "info-top";
      titleD.innerHTML = title;
      closeX.src = "http://webapi.amap.com/images/close2.gif";
      closeX.onclick = closeInfoWindow;

      top.appendChild(titleD);
      top.appendChild(closeX);
      info.appendChild(top);

      // 定义中部内容
      var middle = document.createElement("div");
      middle.className = "info-middle";
      middle.style.backgroundColor = 'white';
      middle.innerHTML = content;
      info.appendChild(middle);

      // 定义底部内容
      var bottom = document.createElement("div");
      bottom.className = "info-bottom";
      bottom.style.position = 'relative';
      bottom.style.top = '0px';
      bottom.style.margin = '0 auto';
      var sharp = document.createElement("img");
      sharp.src = "http://webapi.amap.com/images/sharp.png";
      bottom.appendChild(sharp);
      info.appendChild(bottom);
      return info;
    }

    //关闭信息窗体
    function closeInfoWindow() {
      mapObj.clearInfoWindow();
    }

    for ( var i = 0; i < pocs.length; i += 1) {
      var markerI = new AMap.Marker({
        position : pocs[i].center.split(','),
        title : pocs[i].poc_name,
        //extData : {"iid" : pocs[i].poc_id},
        map : mapObj
      });
      markerI.setExtData(i + "");// pocs[i].poc_id

      AMap.event.addListener(markerI, 'click', _onClick);

    }

</script>

</html>
