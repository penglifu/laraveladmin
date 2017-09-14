@extends('admin/common/layout')


@section('content')


    <title>管理员新增</title>
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
                <form action="" method="get" class="message" >
                    {{csrf_field()}}
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>用户名</label>
                            <input class="text-input small-input" type="text"  name="names"  datatype="*" nullmsg="用户名不能为空" ajaxurl="{{url('admin/messageadmin/insert')}}" />
                        </p>
                        <p>
                            <label>密码</label>
                            <input class="text-input small-input" type="password"  name="password"   datatype="*" nullmsg="密码不能为空" />
                        </p>
                        <p>
                            <label>email</label>
                            <input class="text-input small-input" type="text"  name="email"   datatype="e" nullmsg="email不能为空"  ajaxurl="{{url('admin/messageadmin/insert')}}"/>
                        </p>
                        <p>
                            <label>管理员</label>
                            <select name="level">

                                @foreach($level as $v)
                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
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
    <script type="text/javascript"  src="valite/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript"  src="valite/js/Validform_v5.3.2_min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".message").Validform({
            //alert(1);
            tiptype:3,
            showAllError:true,

        });

    </script>



@endsection