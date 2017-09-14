
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <base href="{{asset("index.php")}}"/>
    <!--                       CSS                       -->
    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
    <!--                       Javascripts                       -->
    <!-- jQuery -->
    <script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="resources/scripts/facebox.js"></script>
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="resources/scripts/jquery.datePicker.js"></script>
    <script type="text/javascript" src="resources/scripts/jquery.date.js"></script>
</head>
<body>
<div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
    <div id="sidebar">
        <div id="sidebar-wrapper">
            <!-- Sidebar with logo and menu -->
            <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>

            <!-- Logo (221px wide) -->
            <a href="http://www.865171.cn"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
            <!-- Sidebar Profile links -->
            <div id="profile-links"> Hello, <a href="#" title="Edit your profile">{{session('names')}}</a>, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br />
                <br />
                <a href="#" title="View the Site">View the Site</a> | <a href="index.php/admin/login/loginout" title="Sign Out">Sign Out</a> </div>

            <ul id="main-nav">
               @foreach($all as $v)
                   @if($v->hidden==0)
                       @if($v->en==$controller)
                        <li> <a href="" class="nav-top-item current">{{$v->name}} </a>
                       @else
                        <li> <a href="" class="nav-top-item">{{$v->name}} </a>
                       @endif
                    @endif
                    <ul>
                        @foreach($v->zi as $v1)
                            @if($v1->hidden==0)
                                @if($v1->en==$method && $v->en==$controller )
                                <li><a class="current" href="index.php/{{$v1->url}}">{{$v1->name}}</a></li>
                                @else
                                <li><a  href="index.php/{{$v1->url}}">{{$v1->name}}</a></li>
                            @endif
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
            </ul>
            <!-- End #main-nav -->
            <div id="messages" style="display: none">
                <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                <h3>3 Messages</h3>
                <p> <strong>17th May 2009</strong> by Admin<br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
                <p> <strong>2nd May 2009</strong> by Jane Doe<br />
                    Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
                <p> <strong>25th April 2009</strong> by Admin<br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
                <form action="#" method="post">
                    <h4>New Message</h4>
                    <fieldset>
                        <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
                    </fieldset>
                    <fieldset>
                        <select name="dropdown" class="small-input">
                            <option value="option1">Send to...</option>
                            <option value="option2">Everyone</option>
                            <option value="option3">Admin</option>
                            <option value="option4">Jane Doe</option>
                        </select>
                        <input class="button" type="submit" value="Send" />
                    </fieldset>
                </form>
            </div>
            <!-- End #messages -->
        </div>
    </div>
    <!-- End #sidebar -->
    <div id="main-content">
        <!-- Main Content Section with everything -->
        <noscript>
            <!-- Show a notification if the user has disabled javascript -->
            <div class="notification error png_bg">
                <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    Download From <a href="http://www.exet.tk">exet.tk</a></div>
            </div>
        </noscript>
        <!-- Page Head -->
        <h2>Welcome www.865171.cn</h2>
        <p id="page-intro">What would you like to do?</p>
        <ul class="shortcut-buttons-set">
            <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/pencil_48.png" alt="icon" /><br />
        Write an Article </span></a></li>
            <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
        Create a New Page </span></a></li>
            <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/image_add_48.png" alt="icon" /><br />
        Upload an Image </span></a></li>
            <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/clock_48.png" alt="icon" /><br />
        Add an Event </span></a></li>
            <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="resources/images/icons/comment_48.png" alt="icon" /><br />
        Open Modal </span></a></li>
        </ul>
        <!-- End .shortcut-buttons-set -->
        <div class="clear"></div>
        <!-- End .clear -->