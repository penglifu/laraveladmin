@extends('admin/common/layout')


@section('content')

        <!--引入副编辑器对应文件  -->
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="uedit/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="uedit/lang/zh-cn/zh-cn.js"></script>
<!--引入副编辑器对应文件  -->
<title>新闻新增</title>
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
                        <input class="text-input small-input" type="text"  name="title" />
                    </p>
                    <p>
                        <label>作者</label>
                        <input class="text-input small-input" type="text"  name="author" />
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
                        <label>新闻简介</label>
                        <textarea rows="2" cols="1"style="width:700px !important; resize: none;" name="des"></textarea>
                    </p>
                    <p>
                        <label>内容来源</label>
                        <input class="text-input small-input" type="text"  name="content_source" />
                    </p>
                    <p>
                        <label>图片来源</label>
                        <input class="text-input small-input" type="text"  name="des_source" />
                    </p>
                    <div>
                        <label>新闻内容</label>
                        <script id="editor"  type="text/plain" style="width:1024px;height:500px;" name="content"></script>
                    </div>
                    <style>
                        .img{width:100px;height:100px; overflow:hidden;}
                    </style>
                    <p>
                        <label>新闻图片上传</label>
                        <input type="file"   name="images" />
                    <div>
                        <img alt="上传图片" src="" class="img" >
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
        var file = this.files[0]; //监听其中的一张图
        if (window.FileReader) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            //监听文件读取结束后事件
            reader.onloadend = function (e) {
                $(".img").attr("src",e.target.result);    //e.target.result就是监听的图片地址
            };

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
