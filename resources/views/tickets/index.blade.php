@extends('admin_template')

@section('content')
<section class="content">

    <!-- Your Page Content Here -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My open tickets</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>183</td>
                            <td>Title</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Midium</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Low</a></li>
                                        <li><a href="#">Midium</a></li>
                                        <li><a href="#">High</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">In progress</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">in progress</a></li>
                                        <li><a href="#">Finished</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Deleted</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><a href="ticket_show.html">Enter</a></td>

                        </tr>
                        <tr>
                            <td>219</td>
                            <td>Alexander Pierce</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Midium</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Low</a></li>
                                        <li><a href="#">Midium</a></li>
                                        <li><a href="#">High</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">In progress</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">in progress</a></li>
                                        <li><a href="#">Finished</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Deleted</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><a href="ticket_show.html">Enter</a></td>
                        </tr>
                        <tr>
                            <td>657</td>
                            <td>Bob Doe</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Midium</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Low</a></li>
                                        <li><a href="#">Midium</a></li>
                                        <li><a href="#">High</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">In progress</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">in progress</a></li>
                                        <li><a href="#">Finished</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Deleted</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><a href="ticket_show.html">Enter</a></td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Other tickets</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending" style="width: 192px;">ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 245px;">Title</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 228px;">Customer</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 165px;">Marked by</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125px;"></th></tr>
                                    </thead>
                                    <tbody>

                                    @foreach($tickets as $ticket)
                                        <tr role="row" class="odd">
                                        <td class="sorting_1">Webkit</td>
                                        <td>Safari 1.2</td>
                                        <td class="">OSX.3</td>
                                        <td>125.5</td>
                                        <td><a href="ticket_show.html">Claim</a></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">{{ $ticket->get_status($ticket->status) }}</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                            
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" class="inprog">in progress</a></li>
                                                    <li><a href="#" class="closed">Closed</a></li>
                                                    <li><a href="#" class="open">Open</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending" style="width: 192px;">ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 245px;">Title</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 228px;">Customer</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 165px;">Marked by</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125px;"></th></tr>
                                    </tfoot>
                                </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
<form  class="myForm" action="/tickets/{{$ticket->id}}" method="post" style="display:none">
    {!! method_field('patch') !!}
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    <input class="val" type="text" name="status"><br><br>
    <input type="submit" value="Submit">
</form>
</section>
@endsection

@section('custom_scripts')
<script type="text/javascript">
$(function () {
    $("a.closed").click(function(){
       $(".val").val('2');
       $(".myForm").submit();
    });
    $("a.inprog").click(function(){
       $(".val").val('1');
       $(".myForm").submit();
    });
    $("a.open").click(function(){
       $(".val").val('0');
       $(".myForm").submit();
    });
});
</script>
@endsection