
@extends('admin/common/layout')


@section('content')

<title>分类修改</title>
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
            <form action="" method="get" enctype="multipart/form-data">
                {{csrf_field()}}
                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>分类修改</label>
                        <input class="text-input small-input" type="text"  name="name" value="{{$current->name}}" />
                    </p>
                    <p>
                        <label>父级的id</label>
                        <input class="text-input small-input" type="text"  name="pid" value="{{$current->pid}}" readonly="readonly" />
                    </p>
                    <p  class="select_cate">
                        <label>选择分类</label>

                        @foreach($category as $k => $v)

                            <select>
                                <option value="-1">上一级</option>

                                @foreach($v as $v1)

                                    @if($v1->id==$k)

                                        <option value="{{$v1->id}}" selected="selected" >{{$v1->name}}</option>

                                        @elseif($v1->id==$current->pid)

                                        <option value="{{$v1->id}}" selected="selected" >{{$v1->name}}</option>

                                        @else

                                        <option value="{{$v1->id}}" > {{$v1->name}} </option>

                                       @endif
                                @endforeach
                            </select>
                        @endforeach

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


<script>
    $(".select_cate select option").eq(0).html("顶级分类");
    $(".select_cate select").live("change",function(){

        $(this).nextAll().remove();
        var id=$(this).val();
        //alert(id);

        if(id==-1){
            //alert(1);
            /* 当id等于-1的时候 */
            if($(".select_cate select").length>1){

                var prev= $(this).prev().val()

                $("input[name='pid']").val(prev);
            }else{

                $("input[name='pid']").val(0);
            }

            //alert(1);
        }else{
            //alert(1);
            /*加到$.ajax请求之前*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"post",
                url:"{{url('admin/category/update')}}/"+id,
                data:{id:id,_token:"{{csrf_token()}}"},
                dataType:"json",
                success:function(msg){

                    //alert(msg);

                    if (msg.length!=0) {
                        var str="";
                        str+='<select>';
                        str+='<option value="-1">上一级</option>';
                        for (var i = 0; i < msg.length; i++) {
                            str+='<option value="'+msg[i]["id"]+'"> '+msg[i]["name"]+'</option>';
                        }
                        str+='</select>';
                        //alert(1);
                        $(".select_cate").append(str); //追加到内部的后面。

                    }else{
                        $(".select_cate").append();

                    }

                }

            })

            $("input[name='pid']").val(id);

        }


    })

</script>

@endsection