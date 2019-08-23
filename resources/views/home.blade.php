@extends('layouts.master')
@section('content')

   
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ url('/dashboard') }}">Home</a>
        </li>
        <li class="active">Dashboard</li>
    </ul><!-- /.breadcrumb -->
  
</div>

        <div class="page-content">            
            <div class="page-header">
                <h1>
                    Dashboard
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Leave Details
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="space-6"></div>

                        <?php //var_dump($leaves); exit; ?>

                   

                        <div class="col-sm-7 infobox-container">
                            <div class="infobox infobox-green">
                               <!--  <div class="infobox-icon">
                                    <i class="ace-icon fa fa-comments"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$leaves->paid_leave}}</span>
                                    <div class="infobox-content">Earn Paid Leave</div>
                                </div>

                                <div class="stat stat-success">PL</div>
                            </div>

                            <div class="infobox infobox-blue">
                                <!-- <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$leaves->sick_leave}}</span>
                                    <div class="infobox-content">Earn Sick Leave</div>
                                </div>

                                <div class="stat stat-success">SL</div>
                            </div>

                            <div class="infobox infobox-blue">
                                <!-- <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$leaves->casual_leave}}</span>
                                    <div class="infobox-content">Earn Others</div>
                                </div>

                                <div class="stat stat-success">OT</div>
                            </div>

                            <div class="infobox infobox-green">
                               <!--  <div class="infobox-icon">
                                    <i class="ace-icon fa fa-comments"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">0</span>
                                    <div class="infobox-content">Spend Paid Leave</div>
                                </div>

                                <div class="stat stat-important">PL</div>
                            </div>

                            <div class="infobox infobox-blue">
                                <!-- <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">0</span>
                                    <div class="infobox-content">Spend Sick Leave</div>
                                </div>

                                <div class="stat stat-important">SL</div>
                            </div>

                            <div class="infobox infobox-blue">
                                <!-- <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div> -->

                                <div class="infobox-data">
                                    <span class="infobox-data-number">0</span>
                                    <div class="infobox-content">Spend Others</div>
                                </div>

                                <div class="stat stat-important">OT</div>
                            </div>

                            <div class="space-6"></div>

                            <div class="infobox infobox-green infobox-small infobox-dark">
                                <div class="infobox-progress">
                                    <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
                                        <span class="percent">61</span>%
                                    </div>
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Task</div>
                                    <div class="infobox-content">Completion</div>
                                </div>
                            </div>

                            <div class="infobox infobox-blue infobox-small infobox-dark">
                                <div class="infobox-chart">
                                    <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Earnings</div>
                                    <div class="infobox-content">$32,000</div>
                                </div>
                            </div>

                            <div class="infobox infobox-grey infobox-small infobox-dark">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-download"></i>
                                </div>

                                <div class="infobox-data">
                                    <div class="infobox-content">Downloads</div>
                                    <div class="infobox-content">1,205</div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="vspace-12-sm"></div>

                        <div class="row">
                        <div class="col-sm-5">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-flat">
                                    <h4 class="widget-title lighter">
                                        <i class="ace-icon fa fa-star orange"></i>
                                        Tickets
                                    </h4>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main no-padding">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Ticket Id
                                                    </th>

                                                    <th>
                                                        <i class="ace-icon fa fa-caret-right blue"></i>Subject
                                                    </th>

                                                    <th class="hidden-480">
                                                        <i class="ace-icon fa fa-caret-right blue"></i>status
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($tickets as $ticket)

                                                <tr>
                                                    <td>#{{$ticket->ticket_id}}</td>
                                                    <td>{{$ticket->subject}}</td>
                                                    <td class="hidden-480">
                                                    @if($ticket->status == 0)
                                                        <span class="label label-danger arrowed">Pending</span>
                                                    @elseif($ticket->status == 1)
                                                        <span class="label label-success arrowed-in arrowed-in-right">Approved</span>
                                                    @else
                                                        <span class="label label-warning arrowed arrowed-right">Rejected</span>
                                                    @endif
                                                    </td>
                                                </tr>

                                            @endforeach 

                                            </tbody>
                                        </table>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->                                   

                <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
    
  
@stop