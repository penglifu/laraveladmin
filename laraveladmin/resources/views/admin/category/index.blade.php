
@extends('admin/common/layout')


@section('content')

<title>分类列表</title>
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Content box</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
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
                    <th>分类列表</th>
                    <th>编辑</th>
                </tr>
                </thead>
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
                        <div class="pagination">
                            <!--  <a href="#" title="First Page">&laquo; First</a>
                             <a href="#" title="Previous Page">&laquo; Previous</a>
                             <a href="#" class="number" title="1">1</a>
                             <a href="#" class="number" title="2">2</a>
                             <a href="#" class="number current" title="3">3</a>
                             <a href="#" class="number" title="4">4</a>
                             <a href="#" title="Next Page">Next &raquo;</a>
                             <a href="#" title="Last Page">Last &raquo;</a> -->

                        </div>
                        <!-- End .pagination -->
                        <div class="clear"></div>
                    </td>
                </tr>
                </tfoot>
                <style>
                    tbody td{ vertical-align: middle; }
                </style>
                <tbody>

                @foreach($category as $v)
                    <tr>
                        <td>
                            <input type="checkbox" />
                        </td>
                        <td>{!! $v->id !!}</td>
                        <td>{!! $v->name !!}</td>
                        <td>
                            <!-- Icons -->
                            <a href="index.php/admin/category/update/{{$v->id}}" title="Edit">
                                <img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                            <a href="index.php/admin/category/delete/{{$v->id}}" title="Delete">
                                <img src="resources/images/icons/cross.png" alt="Delete" /></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
    </div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
@endsection