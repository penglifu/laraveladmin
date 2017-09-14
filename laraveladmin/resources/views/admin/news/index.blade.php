
@extends('admin/common/layout')


 @section('content')

<title>新闻页面</title>


@parent{{--加载父级中定义的区域内容--}}

        <div class="content-box">
            <!-- Start Content Box -->
            <div class="content-box-header">
                <h3>Content box</h3>
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Table</a></li>
                    <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2">Forms</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- End .content-box-header -->
            <div class="content-box-content">
                <div class="tab-content default-tab" id="tab1">
                    <!-- This is the target div. id must match the href of this div's tab -->
                    <div class="notification attention png_bg">
                        <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                        </a>
                        <div> This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross. </div>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>
                                <input class="check-all" type="checkbox" />
                            </th>
                            <th>id</th>
                            <th>标题</th>
                            <th>作者</th>
                            <th>分类</th>
                            <th>图片</th>
                            <th>时间</th>
                            <th>编辑</th>
                        </tr>
                        </thead>
                        <style>
                            tbody td{ vertical-align: middle; }
                            tbody td .img{width: 100px; height: 100px;}
                        </style>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="bulk-actions align-left">
                                    <select name="dropdown">
                                        <option value="option1">Choose an action...</option>
                                        <option value="option2">Edit</option>
                                        <option value="option3">Delete</option>
                                    </select>
                                    <a class="button" href="#">Apply to selected</a>
                                </div>
                                <style>

                                    .pagination ul li{ float:left; list-style: none; }
                                    #main-content ul li{ background: none}
                                </style>
                                <div class="pagination">
                                    {{--<a href="#" title="First Page">&laquo; First</a>
                                    <a href="#" title="Previous Page">&laquo; Previous</a>
                                    <a href="#" class="number" title="1">1</a>
                                    <a href="#" class="number" title="2">2</a>
                                    <a href="#" class="number current" title="3">3</a>
                                    <a href="#" class="number" title="4">4</a>
                                    <a href="#" title="Next Page">Next &raquo;</a>
                                    <a href="#" title="Last Page">Last &raquo;</a>--}}
                                    {!! $page !!}

                                </div>
                                <!-- End .pagination -->
                                <div class="clear"></div>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody>

                      @foreach($ar as $v)
                        <tr>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>{{$v->id}}</td>
                            <td><a >{{$v->title}}</a></td>
                            <td><a >{{$v->author}}</a></td>
                            <td><a>{{$v->name}}</a></td>
                            <td><img class="img" src="{{$v->images}}" alt="新闻图片"></td>
                            <td>{{$v->time}}</td>
                            <td>
                                <!-- Icons -->
                                <a href="index.php/admin/news/update/{{$v->id}}" title="Edit">
                                    <img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="index.php/admin/news/delete/{{$v->id}}" title="Delete">
                                    <img src="resources/images/icons/cross.png" alt="Delete" /></a>

                            </td>
                        </tr>
                     @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- End #tab1 -->
                <div class="tab-content" id="tab2">
                    <form action="#" method="post">
                        <fieldset>
                            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
                                <label>Small form input</label>
                                <input class="text-input small-input" type="text" id="small-input" name="small-input" />
                                <span class="input-notification success png_bg">Successful message</span>
                                <!-- Classes for input-notification: success, error, information, attention -->
                                <br />
                                <small>A small description of the field</small> </p>
                            <p>
                                <label>Medium form input</label>
                                <input class="text-input medium-input datepicker" type="text" id="medium-input" name="medium-input" />
                                <span class="input-notification error png_bg">Error message</span> </p>
                            <p>
                                <label>Large form input</label>
                                <input class="text-input large-input" type="text" id="large-input" name="large-input" />
                            </p>
                            <p>
                                <label>Checkboxes</label>
                                <input type="checkbox" name="checkbox1" />
                                This is a checkbox
                                <input type="checkbox" name="checkbox2" />
                                And this is another checkbox </p>
                            <p>
                                <label>Radio buttons</label>
                                <input type="radio" name="radio1" />
                                This is a radio button<br />
                                <input type="radio" name="radio2" />
                                This is another radio button </p>
                            <p>
                                <label>This is a drop down list</label>
                                <select name="dropdown" class="small-input">
                                    <option value="option1">Option 1</option>
                                    <option value="option2">Option 2</option>
                                    <option value="option3">Option 3</option>
                                    <option value="option4">Option 4</option>
                                </select>
                            </p>
                            <p>
                                <label>Textarea with WYSIWYG</label>
                                <textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79" rows="15"></textarea>
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