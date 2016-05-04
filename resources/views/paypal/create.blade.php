@extends('admin_template')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Generate paypal link</h2>

            <form class="form-horizontal" id="paypalForm" method="post" action="{{ action('GenLinkPaypalController@store') }}">
                <div class="box-body">
                    <input type='hidden' name='_token' value='{{ csrf_token()}}'/>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-sm-2 control-label">Quantity</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" id="price" placeholder="price">
                        </div>
                    </div>
                    <div>
                        <label for="currency" class="col-sm-2 control-label">Currancy</label>
                        <select name="currency" id="currency">
                            <option value="USD">USD</option>
                        </select>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="form-group box-body" style="float: right;">
                    <button type="button" class="btn btn-default" id="resetBtn">Reset</button>
                    <button type="submit" class="btn btn-info" id="genLinkBtn">Generate Link</button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
        <div>
            <br>
            <p id="link"></p>
        </div>
    </div>

@endsection



@section('custom_scripts')

    <script>
        $("button#resetBtn").click(function(){
            $("#name").val('');
            $("#quantity").val('');
            $("#price").val('');
            $("#currency").val('USD');
            $('p#link').text('');
        });


        $('button#genLinkBtn').click(function() {
            var form = document.getElementById("paypalForm");

            $.ajax({
                type: $('#paypalForm').attr('method'),
                url: $('#paypalForm').attr('action'),
                data: $('#paypalForm').serialize(), // serializes the form's elements.
                success: function (data) {
                    $('p#link').text(data.link);
//                    console.log('hello');
                    die();
                },
                error: function (data) {
                    $('p#link').text(data.message);
//                    console.log('hello2');
                    die();
                }
            });
        });

    </script>

@endsection