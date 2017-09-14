
@extends('admin/common/layout')


@section('content')
<title>分类新增</title>
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
                        <label>新增分类</label>
                        <input class="text-input small-input" type="text"  name="name" />
                    </p>

                    <p>
                        <label>选择分类</label>
                        <select name="pid">
                            <option value="0">顶级分类</option>

                            @foreach($category as $v)
                                <option value="{{$v->id}}">{!! $v->name !!}</option>
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
@endsection