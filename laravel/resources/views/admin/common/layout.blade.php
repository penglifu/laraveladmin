@include('admin/common/header'){{--加载头部--}}

{{--加载中间的时候需要定义一块区域：定义这块区域的作用是为了加载不同内容的时候，对应的加载不同的内容，设置一个位置--}}
{{--@yield('content')--}}{{--@yield('content')这种写法适用于当前页面没有内容需要输出的时候，
如果当前页面有内容需要输出的时候可以用以下方法：--}}

@section("content")
 我存在

@show




@include('admin/common/footer'){{--加载尾部--}}