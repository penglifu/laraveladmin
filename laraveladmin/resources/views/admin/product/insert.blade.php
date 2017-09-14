@extends('admin/common/layout')


@section('content')
<!--引入副编辑器对应文件  -->
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="uedit/lang/zh-cn/zh-cn.js"></script>
<!--引入副编辑器对应文件  -->
<title>产品新增</title>
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Content box</h3>
        <ul class="content-box-tabs">
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Forms</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
            <form action="" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>标题</label>
                        <input class="text-input small-input a" type="text"  name="des" />
                    </p>
                    <p>
                        <label>首页介绍</label>
                        <input class="text-input small-input b" type="text"  name="introduce[]" />
                        <input class="text-input small-input c" type="text"  name="introduce[]" />
                        <input class="text-input small-input d" type="text"  name="introduce[]" />
                    </p>
                    <p>
                        <label>价格</label>
                        <input class="text-input small-input e" type="text"  name="price" />
                    </p>
                    <p>
                        <label>促销价</label>
                        <input class="text-input small-input f" type="text"  name="promotion_price" />
                    </p>
                    <label>厚度</label>
                    <p class="thickness">

                        <input class="text-input  thick" type="checkbox"  value="常规"  name="thickness[]" />常规
                        <input class="text-input  thick" type="checkbox"  value="超厚"  name="thickness[]" />超厚
                    </p>
                    <a>厚度库存</a>
                    <ul class="thickrepertory" >


                    </ul>
                    <label>尺码</label>
                    <p class="size">

                        <input class="text-input size1" type="checkbox"  value="S"  name="size[]" />S
                        <input class="text-input size1" type="checkbox"  value="M"  name="size[]" />M
                        <input class="text-input size1" type="checkbox"  value="L"  name="size[]" />L
                        <input class="text-input size1" type="checkbox"  value="XL"  name="size[]" />XL
                    </p>
                    <a>尺码库存</a>
                    <ul class="sizerepertory" >


                    </ul>
                    <p>
                        <label>产品参数</label>
                        <input class="text-input " type="text"  name="texture" />材质成分
                        <input class="text-input " type="text"  name="article_number" />货号
                        <input class="text-input " type="text"  name="trademark" />品牌
                        <input class="text-input " type="text"  name="outside_sleeve" />袖长
                        <input class="text-input " type="text"  name="buckle" />衣门襟
                    </p>
                    <p>
                        <input class="text-input " type="text"  name="applicable_age" />适用年龄
                        <input class="text-input " type="text"  name="distribution_channel" /> 销售渠道类型
                        <input class="text-input " type="text"  name="model" /> 服装版型
                        <input class="text-input " type="text"  name="combining_form" />  组合形式
                        <input class="text-input " type="text"  name="collar" /> 领子
                    </p>
                    <p>
                        <input class="text-input " type="text"  name="pattern" />图案
                        <input class="text-input " type="text"  name="annual_seasons" /> 年份季节
                        <input class="text-input " type="text"  name="style" /> 风格
                        <input class="text-input " type="text"  name="clothes_length" /> 衣长
                        <input class="text-input " type="text"  name="sleeve_style" /> 袖型
                    </p>
                    <p>
                        <input class="text-input " type="text"  name="technology" />流行元素/工艺
                        <input class="text-input " type="text"  name="color" />颜色分类
                    </p>
                    <p>
                        <label>分类</label>
                        <select name="category">
                            @foreach($category as $v)
                                <option value="{{$v->id}}" >{{$v->name}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>产品简介</label>
                        <textarea rows="2" cols="1"style="width:700px !important; resize: none;" name="title"></textarea>
                    </p>
                    <style>

                        #main-content .images_list {padding-top:30px; overflow:hidden;}
                        #main-content .images_list li{list-style: none; margin-left:15px; padding:0; position: relative;width:100px; height:100px;float:left;}
                        #main-content .images_list li img{width:100px;height:100px; overflow:hidden;}
                        #main-content  .images_list li div{width:100px;height:100px;
                            display: none;
                            position: absolute;
                            left: 0;top: 0;
                            background-color: rgba(100,140,120,0.4);
                            float: left;}
                        #main-content  .images_list li div img{ width: 30px;
                            height: 30px;
                            position: absolute;
                            top:-15px;right:-15px;
                        }
                        #main-content  .images_list li:hover div{display: block; cursor: pointer;}
                    </style>
                    <p>
                        <label>产品图片上传</label>
                        <input type="file"   name="images[]" multiple="multiple" />
                    <div>
                        <ul class="images_list">


                        </ul>
                        <label>颜色库存</label>
                        <a>点击图片生成库存输入框</a><br/>
                        <ul class="repertory">


                        </ul>
                    </div>
                    </p>
                    <p>
                        <input class="button" type="submit" value="Submit" />
                    </p>
                </fieldset>
                <div class="clear"></div>
                <!-- End .clear -->
            </form>
        </div>
        <!-- End #tab2 -->
    </div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
<script type="text/javascript">
    $("input[type='file']").change(function(){
        var j=0;/* 定义变量j表示图片下标 */
        for (var i = 0; i < this.files.length; i++) {/* 循环图片下标 */
            var file = this.files[i]; /* 监听其中的一张图 */
            if (window.FileReader) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                //监听文件读取结束后事件
                reader.onloadend = function (e) {
                    //e.target.result就是监听的图片地址
                    var str="";

                    str+="<li>";
                    str+="<img src='"+e.target.result+"' />";
                    str+="<input type='hidden' value='"+j+"' name='check_image[]' />"
                    str+="<div><img class='delete' src='fancy_close.png' /></div>";
                    str+="</li>";

                    $(".images_list").append(str);
                    j++;

                };

            }
        }
    })

    $(".delete").live("click",function(){

        $(this).parent().parent().remove();
        $(".repertory").children(":last").remove();


    })


    //生成库存
    $(".thick").click(function(){
        var status=$(this).is(":checked");
        var length=$(".thickness input:checked").length;
        var length1=$(".thickrepertory input").length;
        if(status){
            if(length1<length){
                for(var i=0;i<length; i++){
                    var length2=$(".thickrepertory input").length;
                    if(length2<length){
                        var str="";
                        str+="<input class='text-input thickchang' type='text'   name='thickrepertory[]' />";

                        $(".thickrepertory").append(str);
                    }
                }
            }
        }else{

            $(".thickrepertory").children(":last").remove();
        }
    })



    $(".size1").click(function(){
        var status=$(this).is(":checked");
        var length=$(".size input:checked").length;
        var length1=$(".sizerepertory input").length;
        if(status){
            if(length1<length){
                for(var i=0; i<length; i++){
                    var length2=$(".sizerepertory input").length;
                    if(length2<length){
                        var str="";
                        str+="<input class='text-input se1' type='text'  name='sizerepertory[]' />";

                        $(".sizerepertory").append(str);
                    }

                }

            }
        }else{

            $(".sizerepertory").children(":last").remove();
        }


    })





    $(".images_list li  ").live("click",function(){
        var length=$(".images_list li").length;
        //alert(length);
        var length1=$(".repertory input").length;
        var j=0;
        if(length1<length){
            for(var i=0;i<length;i++){
                var str="";
                str+="<input class='text-input color' type='text'     name='colorrepertory[]' />";

                $(".repertory").append(str);

            }

        }
    })



    $(".button").live("click",function(){

        var text = $(".a").val();
        if(!text){
            alert("请输入标题！ ");

            return false ;
        }


        var text = $(".b").val();
        if(!text){
            alert("请输入首页介绍！ ");

            return false ;
        }


        var text = $(".c").val();
        if(!text){
            alert("请输入首页介绍！ ");

            return false ;
        }

        var text = $(".d").val();
        if(!text){
            alert("请输入首页介绍！ ");

            return false ;
        }


        var text = $(".e").val();
        if(!text){
            alert("请输入价格！ ");

            return false ;
        }


        var text = $(".f").val();
        if(!text){
            alert("请输入促销价！ ");

            return false ;
        }

        var length=$("input[name='thickness[]']:checked").length;
        if(length<1){
            alert("请选择厚度！ ");

            return false ;
        }

        var length=$(".thickrepertory input").length;
        //alert(length);
        for(var i=0; i<length;i++){
            var text = $(".thickchang").eq(i).val();
            if(!text){
                alert("请输入厚度库存！");

                return false ;
            }
        }


        var length=$("input[name='size[]']:checked").length;
        if(length<1){
            alert("请选择尺码！ ");

            return false ;
        }


        var length=$(".sizerepertory input").length;
        //alert(length);
        for(var i=0; i<length;i++){
            var text = $(".se1").eq(i).val();
            if(!text){
                alert("请输入尺码库存！");

                return false ;
            }
        }




        var length=$(".images_list li").length;
        if(length<1){
            alert("请选择颜色图片！ ");

            return false ;
        }

        var length=$(".repertory input").length;
        //alert(length);
        for(var i=0; i<length;i++){
            var text = $(".color").eq(i).val();
            if(!text){
                alert("请输入颜色库存！");

                return false ;
            }
        }



    })


    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }

</script>

@endsection