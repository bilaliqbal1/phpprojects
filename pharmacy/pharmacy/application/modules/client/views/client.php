<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>   Client
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> Register New Client
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Client Id</th>                        
                                <th>Name</th>
                                <th>Phone</th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <th>Due Balance</th>
                                <?php } ?>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>
                        <?php foreach ($clients as $client) { if($client->email != 'client@dms.com'){ ?>
                            <tr class="">
                                <td> <?php echo $client->client_id; ?></td>
                                <td> <?php echo $client->name; ?></td>
                                <td><?php echo $client->phone; ?></td>


                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <td> <?php echo $settings->currency; ?>
                                        <?php
                                        $query = $this->db->get_where('payment', array('client' => $client->id))->result();

                                        $balance = array();

                                        foreach ($query as $gross) {

                                            $balance[] = $gross->gross_total - $gross->amount_received;
                                        }
                                        $balance = array_sum($balance);

                                        $due_balance = $balance;

                                        echo $due_balance;

                                        $due_balance = NULL;
                                        ?>
                                    </td>
                                <?php } ?>






                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" style="width: 100px;" data-toggle="modal" data-id="<?php echo $client->id; ?>"><i class="fa fa-edit"></i> Edit</button> 
                                    <!--
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        <a class="btn btn-info btn-xs btn_width invoicebutton" style="width: 100px;" href="finance/invoiceClientTotal?id=<?php echo $client->id; ?>"><i class="fa fa-file-text"></i> Invoice</a>


                                        <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="finance/addPaymentByClientView?id=<?php echo $client->id; ?>&type=gen"><i class="fa fa-money"></i> Payment</a>
                                    <?php } ?>
                                    -->
                                    <a class="btn btn-info btn-xs btn_width delete_button" style="width: 100px;" href="client/delete?id=<?php echo $client->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Client Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Client Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="client/addNew" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($client->client_id)) {
                        echo $client->client_id;
                    }
                    ?>'>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Client Modal-->







<!-- Edit Client Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Client Information</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editClientForm" action="client/addNew" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Client Modal-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editClientForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'client/editClientByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server

                                                    $('#editClientForm').find('[name="id"]').val(response.client.id).end()
                                                    $('#editClientForm').find('[name="name"]').val(response.client.name).end()
                                               //     $('#editClientForm').find('[name="password"]').val(response.client.password).end()
                                                    $('#editClientForm').find('[name="email"]').val(response.client.email).end()
                                                    $('#editClientForm').find('[name="address"]').val(response.client.address).end()
                                                    $('#editClientForm').find('[name="phone"]').val(response.client.phone).end()
                                                    $('#editClientForm').find('[name="p_id"]').val(response.client.client_id).end()
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

