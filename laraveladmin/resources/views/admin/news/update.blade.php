@extends('admin/common/layout')


@section('content')

        <!--引入副编辑器对应文件  -->
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="uedit/lang/zh-cn/zh-cn.js"></script>
<!--引入副编辑器对应文件  -->
<title>新闻修改</title>
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
                {{csrf_field()}}{{--token--}}
                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>标题</label>
                        <input class="text-input small-input" type="text"  name="title" value="{{$ar->title}}" />
                    </p>
                    <p>
                        <label>作者</label>
                        <input class="text-input small-input" type="text"  name="author" value="{{$ar->author}}"  />
                    </p>
                    <p>
                        <label>分类</label>
                        <select name="category">
                            @foreach($categoryall as $v)
                                @if($category_id == $v->id)
                                    <option value="{{$v->id}}" selected="selected" >{{$v->name}}</option>
                                    @else
                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>内容来源</label>
                        <input class="text-input small-input" type="text"  name="content_source" value="{{$ar->content_source}}" />
                    </p>
                    <p>
                        <label>图片来源</label>
                        <input class="text-input small-input" type="text"  name="des_source" value="{{$ar->des_source}}" />
                    </p>
                    <p>
                        <label>新闻简介</label>
              <textarea rows="2" cols="1"style="width:700px !important; resize: none;" name="des"  >
              {{$ar->des}}
              </textarea>
                    </p>
                    <div>
                        <label>新闻内容</label>
                        <script id="editor"  type="text/plain" style="width:1024px;height:500px;" name="content">
                 {{strip_tags($ar->content)}}
                </script>
                    </div>
                    <style>

                        #main-content .images_list {padding-top:30px;  overflow:hidden;}
                        #main-content .images_list li{list-style: none; margin-left:15px; padding:0; position: relative;width:100px; height:100px;float:left;}
                        #main-content .images_list li img{width:100px;height:100px; overflow:hidden;}
                        #main-content .images_list li div{width:100px;height:100px;
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
                    <div>
                        <label>原图显示</label>
                        <ul class="images_list">
                            <li>
                                <img alt="上传图片" src="{{$ar->images}}" class="img" >
                                <div><img src="fancy_close.png" class="delete" /></div>
                                <input type="hidden"   name="images_old" value="1" />
                            </li>
                        </ul>
                    </div>
                    <div>
                        <label>修改图片</label>
                        <input type="file"   name="images" />
                        <ul class="images_list images_new">

                        </ul>
                    </div>
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
        var file = this.files[0]; //监听其中的一张图
        if (window.FileReader) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            //监听文件读取结束后事件
            reader.onloadend = function (e) {
                //e.target.result就是监听的图片地址

                var str="";
                str+='<li>';
                str+='<img alt="上传图片" src="'+e.target.result+'"  >';
                str+='<input type="hidden"   name="images" value="2" />';
                str+='<div><img src="fancy_close.png" class="delete" /></div>';
                str+='</li>';
                $(".images_new").append(str);
            };


        }
    })

    $(".delete").live("click",function(){

        $(this).parent().parent().remove();



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