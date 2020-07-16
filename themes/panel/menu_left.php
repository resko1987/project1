<div class="sidebar-scrollbar">

    <!-- sidebar menu -->
    <ul class="nav sidebar-inner" id="sidebar-menu">



        <li  class="has-sub <?= ($_SESSION['page_url'] == 'admin') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link" href="/admin/" >
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span class="nav-text">Статистика</span> 
            </a>
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'pages') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/pages/">
                <i class="mdi mdi-image-filter-none"></i>
                <span class="nav-text">Страницы</span> </b>
            </a>

        </li>



        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#system_configs"
               aria-expanded="false" aria-controls="system_configs">
                <i class="mdi mdi-pencil-box-multiple"></i>
                <span class="nav-text">Настройки</span> <b class="caret"></b>
            </a>
            <ul  class="collapse <?= ($_SESSION['page_url'] == 'system_configs') ? 'show' : '' ?>"  id="system_configs"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">


                    <li class="<?= ($_SESSION['page_url'] == 'system_configs') ? 'active' : '' ?>">
                        <a class="sidenav-item-link" href="/admin/system_configs/">
                            <span class="nav-text">Настройки сайта <?= $_SESSION['page_url'] ?></span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/admin/other_config/">
                            <span class="nav-text">Другие настройки</span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/admin/langs/">
                            <span class="nav-text">Переводы сайта</span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/metrix/">
                            <span class="nav-text">Метрики и счетчики</span>
                        </a>
                    </li>

                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
               aria-expanded="false" aria-controls="components">
                <i class="mdi mdi-folder-multiple-outline"></i>
                <span class="nav-text">Components</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="components"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="alert.html">
                            <span class="nav-text">Alert</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="badge.html">
                            <span class="nav-text">Badge</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="breadcrumb.html">
                            <span class="nav-text">Breadcrumb</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="button-default.html">
                            <span class="nav-text">Button Default</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="button-dropdown.html">
                            <span class="nav-text">Button Dropdown</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="button-group.html">
                            <span class="nav-text">Button Group</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="button-social.html">
                            <span class="nav-text">Button Social</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="button-loading.html">
                            <span class="nav-text">Button Loading</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="card.html">
                            <span class="nav-text">Card</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="carousel.html">
                            <span class="nav-text">Carousel</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="collapse.html">
                            <span class="nav-text">Collapse</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="list-group.html">
                            <span class="nav-text">List Group</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="modal.html">
                            <span class="nav-text">Modal</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="pagination.html">
                            <span class="nav-text">Pagination</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="popover-tooltip.html">
                            <span class="nav-text">Popover & Tooltip</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="progress-bar.html">
                            <span class="nav-text">Progress Bar</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="spinner.html">
                            <span class="nav-text">Spinner</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="switcher.html">
                            <span class="nav-text">Switcher</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="tab.html">
                            <span class="nav-text">Tab</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
               aria-expanded="false" aria-controls="icons">
                <i class="mdi mdi-diamond-stone"></i>
                <span class="nav-text">Icons</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="icons"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="material-icon.html">
                            <span class="nav-text">Material Icon</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="flag-icon.html">
                            <span class="nav-text">Flag Icon</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#forms"
               aria-expanded="false" aria-controls="forms">
                <i class="mdi mdi-email-mark-as-unread"></i>
                <span class="nav-text">Forms</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="forms"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="basic-input.html">
                            <span class="nav-text">Basic Input</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="input-group.html">
                            <span class="nav-text">Input Group</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="checkbox-radio.html">
                            <span class="nav-text">Checkbox & Radio</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="form-validation.html">
                            <span class="nav-text">Form Validation</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="form-advance.html">
                            <span class="nav-text">Form Advance</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tables"
               aria-expanded="false" aria-controls="tables">
                <i class="mdi mdi-table"></i>
                <span class="nav-text">Tables</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="tables"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="basic-tables.html">
                            <span class="nav-text">Basic Tables</span>

                        </a>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#data-tables"
                           aria-expanded="false" aria-controls="data-tables">
                            <span class="nav-text">Data Tables</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="data-tables">
                            <div class="sub-menu">

                                <li >
                                    <a href="basic-data-table.html">Basic Data Table</a>
                                </li>

                                <li >
                                    <a href="responsive-data-table.html">Responsive Data Table</a>
                                </li>

                                <li >
                                    <a href="hoverable-data-table.html">Hoverable Data Table</a>
                                </li>

                                <li >
                                    <a href="expendable-data-table.html">Expendable Data Table</a>
                                </li>

                            </div>
                        </ul>
                    </li>



                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#maps"
               aria-expanded="false" aria-controls="maps">
                <i class="mdi mdi-google-maps"></i>
                <span class="nav-text">Maps</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="maps"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="google-map.html">
                            <span class="nav-text">Google Map</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="vector-map.html">
                            <span class="nav-text">Vector Map</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#widgets"
               aria-expanded="false" aria-controls="widgets">
                <i class="mdi mdi-widgets"></i>
                <span class="nav-text">Widgets</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="widgets"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="general-widget.html">
                            <span class="nav-text">General Widget</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="chart-widget.html">
                            <span class="nav-text">Chart Widget</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>





        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
               aria-expanded="false" aria-controls="charts">
                <i class="mdi mdi-chart-pie"></i>
                <span class="nav-text">Charts</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="charts"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li >
                        <a class="sidenav-item-link" href="chartjs.html">
                            <span class="nav-text">ChartJS</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>











        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
               aria-expanded="false" aria-controls="documentation">
                <i class="mdi mdi-book-open-page-variant"></i>
                <span class="nav-text">Documentation</span> <b class="caret"></b>
            </a>
            <ul  class="collapse"  id="documentation"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">



                    <li class="section-title">
                        Getting Started
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="introduction.html">
                            <span class="nav-text">Introduction</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="quick-start.html">
                            <span class="nav-text">Quick Start</span>

                        </a>
                    </li>






                    <li >
                        <a class="sidenav-item-link" href="customization.html">
                            <span class="nav-text">Customization</span>

                        </a>
                    </li>






                    <li class="section-title">
                        Layouts
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#headers"
                           aria-expanded="false" aria-controls="headers">
                            <span class="nav-text">Header Variations</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="headers">
                            <div class="sub-menu">

                                <li >
                                    <a href="header-fixed.html">Header Fixed</a>
                                </li>

                                <li >
                                    <a href="header-static.html">Header Static</a>
                                </li>

                                <li >
                                    <a href="header-light.html">Header Light</a>
                                </li>

                                <li >
                                    <a href="header-dark.html">Header Dark</a>
                                </li>

                            </div>
                        </ul>
                    </li>




                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-navs"
                           aria-expanded="false" aria-controls="sidebar-navs">
                            <span class="nav-text">Sidebar Variations</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="sidebar-navs">
                            <div class="sub-menu">

                                <li >
                                    <a href="sidebar-fixed-default.html">Sidebar Fixed Default</a>
                                </li>

                                <li >
                                    <a href="sidebar-fixed-minified.html">Sidebar Fixed Minified</a>
                                </li>

                                <li >
                                    <a href="sidebar-fixed-offcanvas.html">Sidebar Fixed Offcanvas</a>
                                </li>

                                <li >
                                    <a href="sidebar-static-default.html">Sidebar Static Default</a>
                                </li>

                                <li >
                                    <a href="sidebar-static-minified.html">Sidebar Static Minified</a>
                                </li>

                                <li >
                                    <a href="sidebar-static-offcanvas.html">Sidebar Static Offcanvas</a>
                                </li>

                                <li >
                                    <a href="sidebar-with-footer.html">Sidebar With Footer</a>
                                </li>

                                <li >
                                    <a href="sidebar-without-footer.html">Sidebar Without Footer</a>
                                </li>

                                <li >
                                    <a href="right-sidebar.html">Right Sidebar</a>
                                </li>

                            </div>
                        </ul>
                    </li>





                    <li >
                        <a class="sidenav-item-link" href="rtl.html">
                            <span class="nav-text">RTL Direction</span>

                        </a>
                    </li>




                </div>
            </ul>
        </li>



    </ul>

</div>