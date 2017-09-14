<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{


    /*
     * 生成分页
     *$ar为分页记录数据
     * */
    public function pageNum($ar)
    {
        //分页页码

        $currentpage = $ar->currentPage();//当前页
        $firstItem = $ar->firstItem();//当前页的第一条记录在数据库中排第几条
        $lastItem = $ar->lastItem();//当前页面最后一条记录在数据库中排第几条
        $lastPage = $ar->lastPage();//最后一页页码
        $nextPageUrl = $ar->nextPageUrl();//下一页的超链接地址
        $perPage = $ar->perPage();//每页显示的记录条数等于paginate(5)中设定的数字。
        $previousPageUrl = $ar->previousPageUrl();//上一页的超链接地址
        $total = $ar->total();//查询出的总记录条数
        $url = $ar->url(0);//url(3）当在其中输入页码的时候就会得到第几页的超链接,里面必须给默认值
        //print_r($lastPage);die;


        $fix_num = 5;//定义一个变量固定显示几页
        $firstpage = $currentpage - floor($fix_num / 2);//固定显示几页页码之后的开始页


        $endpage = $currentpage + floor($fix_num / 2);

        // print_r($endpage);die;
        $page = "";
        //拼接第一页
        $page .= '<a href="' . $ar->url(1) . '" title="First Page">&laquo; First</a>';


        //拼接第上一页
        $Previous = $currentpage - 1;//上一页
        if ($Previous < 1) {//判断上一页小于一
            $page .= '<a href="' . $ar->url(1) . '" title="Previous Page">&laquo; Previous</a>';
        } else {
            $page .= '<a href="' . $ar->url($Previous) . '" title="Previous Page">&laquo; Previous</a>';
        }


//拼接页码和当前页
//当开始页小于一
        if ($firstpage < 1) {
            $firstpage = 1;
            $endpage = $fix_num;

        }

//当结束页大于最后一页页码数
        if ($endpage > $lastPage) {
            $endpage = $lastPage;
            $firstpage = $lastPage - $fix_num + 1;
        }

//当最后一页小于固定页码


        if ($lastPage < $fix_num) {
            $endpage = $lastPage;
            $firstpage = 1;
        }
//print_r($endpage);die;

//循环页码：
        for ($i = $firstpage; $i <= $endpage; $i++) {


            if ($i == $currentpage) {

                $page .= '<a href="' . $ar->url($i) . '" class="number current" title="' . $i . '">' . $i . '</a>';

            } else {
                $page .= '<a href="' . $ar->url($i) . '" class="number " title="' . $i . '">' . $i . '</a>';

            }

            // print_r($i);die;
        }


//拼接下一页
        $NextPage = $currentpage + 1;//下一页
        if ($NextPage > $lastPage) {//判断下一页大于总页码
            $page .= '<a href="' . $ar->url($lastPage) . '" title="Next Page">Next &raquo;</a>';
        } else {
            $page .= '<a href="' . $ar->url($NextPage) . '" title="Next Page">Next &raquo;</a>';
        }


//拼接最后一页
        $page .= '<a href="' . $ar->url($lastPage) . '" title="Last Page">Last &raquo;</a>';

         return $page;//返回分页page
    }
}
