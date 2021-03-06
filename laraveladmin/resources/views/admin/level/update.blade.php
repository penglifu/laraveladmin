
@extends('admin/common/layout')


@section('content')


    <title>权限修改</title>
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
                            <label>权限名称</label>
                            <input class="text-input small-input" type="text"  name="name" value="{{$arr->name}}" />
                        </p>
                        <p>
                            <input class="text-input all" type="checkbox"  />全选
                        </p>
                        <style>
                            .bold{font-weight: bold;}
                        </style>

                        @foreach($sidemeun as $v)
                            <p class="check">
                                @if(in_array($v->level,$arr->level))
                                    <input class="text-input check1" type="checkbox"  checked="checked"  name="level[]" value="{{$v->id}}" /><span class="bold" >{{$v->name}}</span>
                                    @else
                                    <input class="text-input check1" type="checkbox"   name="level[]" value="{{$v->id}}" /><span class="bold" >{{$v->name}}</span>
                                @endif
                                <br/>

                                @foreach( $v->zi as $v1)

                                    @if(in_array($v1->level,$arr->zi))
                                        <input class="text-input check2 " type="checkbox" checked="checked" name="zi[]"  value="{{$v1->level}}" />{{$v1->name}}
                                        @else
                                        <input class="text-input check2 " type="checkbox" name="zi[]"  value="{{$v1->level}}}" />{{$v1->name}}
                                    @endif
                               @endforeach
                            </p>

                      @endforeach
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

    <script>
        //判断全选
        $(".all").click(function(){
            //alert(1);
            //判断复选框状态
            var status = $(this).is(":checked");
            if(status){
                $(".check input").attr("checked",true);

            }else{
                $(".check input").attr("checked",false);

            }

        })

        //判断 中心
        $(".check1").click(function(){
            var status = $(this).is(":checked");
            if(status){
                $(this).siblings(".check2").attr("checked",true);

            }else{
                $(this).siblings(".check2").attr("checked",false);

            }

            allStatus();
        })

        //判断 中心下面的子

        $(".check2").click(function(){

            var status=$(this).is(":checked");
            //判断 check2是否全选
            if(status){
                $(this).siblings(".check1").attr("checked",true);

            }else{
                var length = $(this).siblings("input:checked").length;
               // alert(length);
                //判断check2选中的长度
                if(length<2){
                    $(this).siblings(".check1").attr("checked",false);

                }

            }
            allStatus();
        })
        //当所有input选中时必须选中全选
        function allStatus(){

            var length = $(" .check input").length;
            var check_length=$(".check input:checked").length;
            //alert(1);
            if(length==check_length){
                $(".all").attr("checked",true);

            }else{
                $(".all").attr("checked",false);

            }


        }



    </script>


@endsection