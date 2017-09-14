
@extends("admin/common/layout"){{--加载头部和尾部，这里继承的是公共区域common文件下layout中加载的头和尾--}}

{{--下面的写法是为了把中间的内容放入在公共php页面中定义一个放置中间内容的区域当中
这时候，layout相当于当前文件的父级，如果父级中内容的时候就用@parent来输出，如果不添加就不会在当前
页面输出layout页面的内容，同时$parent放在哪个位置，layout中的content的内容就在哪儿输出，注意：
@parent只有content区域以内才能被解析输出。
--}}
@section("content")
    @parent
<div class="zhon">zhon</div>
@endsection
