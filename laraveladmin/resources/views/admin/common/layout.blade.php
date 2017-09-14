{{--
  布局页面：layout
--}}

{{--加载头部--}}
@include('admin/common/header')

{{--@yield('content')--}}{{--@yield('content')这种写法适用于当前页面没有内容需要输出的时候，
如果当前页面有内容需要输出的时候可以用以下方法：--}}


@section('content')

 撒点开放女士看得开三地块卢萨卡

@show{{--在模板中加载这块区域一定要用@show--}}

{{--加载尾部--}}
@include('admin/common/footer')