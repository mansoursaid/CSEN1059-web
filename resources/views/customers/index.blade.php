@extends('admin_template')

@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary pull-right"
                            onclick="window.location='{{ route("customers.create") }}'">Create
                    </button>
                    <h3 class="box-title">All Customers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row" class="odd">
                            <th class="sorting_1">Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Twitter handle</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                @if(!empty($customer->phone_number))
                                    <td>{{ $customer->phone_number }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if(!empty($customer->twitter_handle))
                                    <td>{{ $customer->twitter_handle }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    <a href="{{ action('CustomerController@edit', [$customer->id]) }}">Edit</a>&nbsp;|&nbsp;
                                    <a href="{{ action('CustomerController@openTicket', [$customer->id]) }}">Create Ticket</a>
                                    <br>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{--<tfoot>--}}
                        {{--<tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending" style="width: 192px;">ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 245px;">Title</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 228px;">Customer</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 165px;">Marked by</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125px;"></th></tr>--}}
                        {{--</tfoot>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
