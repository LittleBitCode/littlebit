<template>
    <div>
        <!--<input type="text" id="suggestId" name="address_detail" placeholder="地址" v-model="address_detail" class="input_style">-->
        <!--<input type="text" id="suggestId" name="address" placeholder="地址" v-model="address" class="input_style">-->
        <v-text-field
                id="suggestId"
                name="address"
                hint="请输入小区/大厦/商场/交叉路口/标志建筑等关键词检索"
                value=""
                class="input-group--focused"
        ></v-text-field>
        <div id="allmap"></div>
    </div>
</template>

<script>
    //import {MP} from ‘../../map‘
    import BaiduMap from '../../plugins/baidu-map'
//    import TextInput from './TextInput'

    export default {
//        extends:TextInput,
        name:'b-map-search',
        data(){
            return {
                address: null, //详细地址
                userlocation: {lng: "", lat: ""},
            }
        },
        mounted(){
            BaiduMap.init().then((BMap)=>{
//                console.log(BMap);
                console.log("加载成功...")
                var th = this
                // 创建Map实例
                var map = new BMap.Map("allmap");
                // 初始化地图,设置中心点坐标，
                var point = new BMap.Point(113.69963, 34.80451); // 创建点坐标，汉得公司的经纬度坐标
                map.centerAndZoom(point, 15);
                map.enableScrollWheelZoom();
                var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
                    {
                        "input": "suggestId",
                        "location": map
                    });
                var myValue;
                ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
                    var _value = e.item.value;
                    myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
                    this.address = myValue;
                    setPlace();
                });

                function setPlace() {
                    map.clearOverlays();    //清除地图上所有覆盖物
                    function myFun() {
                        th.userlocation = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
                        map.centerAndZoom(th.userlocation, 18);
                        map.addOverlay(new BMap.Marker(th.userlocation));    //添加标注
                    }

                    var local = new BMap.LocalSearch(map, { //智能搜索
                        onSearchComplete: myFun
                    });
                    local.search(myValue);

                    //测试输出坐标（指的是输入框最后确定地点的经纬度）
                    map.addEventListener("click",function(e){
                        //经度
                        console.log(th.userlocation.lng);
                        //维度
                        console.log(th.userlocation.lat);

                    })
                }
            });

        },
    }
</script>

<style scoped>
    #allmap{
        width: 100%;
        height: 400px;
        font-family: "微软雅黑";
        border:1px solid green;
        display: none;
    }
</style>

