<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('all_pharmacy'); ?>
            </header>

            <style>
                
                
                .editbutton{
                    width: auto !important;
                }
                
                .delete_button{
                    width: auto !important;
                }
                
                .status{
                    background: #123412 !important;
                }
                
                
            </style>
          


            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>   <?php echo lang('create_new_pharmacy'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('title'); ?></th>
                                <th> <?php echo lang('email'); ?></th>
                                <th> <?php echo lang('address'); ?></th>
                                <th> <?php echo lang('phone'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th class="no-print"> <?php echo lang('options'); ?></th>
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

                        <?php foreach ($pharmacys as $pharmacy) { ?>
                            <tr class="">
                                <td> <?php echo $pharmacy->name; ?></td>
                                <td><?php echo $pharmacy->email; ?></td>
                                <td class="center"><?php echo $pharmacy->address; ?></td>
                                <td><?php echo $pharmacy->phone; ?></td>
                                <td>
                                    <?php
                                    $status = $this->db->get_where('users', array('id' => $pharmacy->ion_user_id))->row()->active;
                                    if ($status == '1') {
                                        ?>
                                        <button type="button" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="<?php echo $pharmacy->id; ?>"><?php echo lang('active'); ?></button> 
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-info btn-xs delete_button" data-toggle="modal" data-id="<?php echo $pharmacy->id; ?>"><?php echo lang('disabled'); ?></button> 
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <?php
                                    $status = $this->db->get_where('users', array('id' => $pharmacy->ion_user_id))->row()->active;
                                    if ($status == '1') {
                                        ?>
                                    <a href="pharmacy/deactivate?pharmacy_id=<?php echo $pharmacy->ion_user_id;?>" type="button" class="btn btn-info btn-xs status" data-toggle="modal" data-id="<?php echo $pharmacy->id; ?>"><?php echo lang('disable'); ?></a>  

                                    <?php } else { 
                                        ?>

                                        <a href="pharmacy/activate?pharmacy_id=<?php echo $pharmacy->ion_user_id;?>" type="button" class="btn btn-info btn-xs status" data-toggle="modal" data-id="<?php echo $pharmacy->id; ?>"><?php echo lang('enable'); ?></a>  
                                        <?php
                                    }
                                    ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $pharmacy->id; ?>"><i class="fa fa-edit"></i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="pharmacy/delete?id=<?php echo $pharmacy->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>

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






<!-- Add Event Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('create_new_pharmacy'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pharmacy/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php echo lang('edit_pharmacy'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPharmacyForm" action="pharmacy/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editPharmacyForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'pharmacy/editPharmacyByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editPharmacyForm').find('[name="id"]').val(response.pharmacy.id).end()
                                                //   $('#editEventForm').find('[name="p_id"]').val(response.client.client_id).end()
                                                $('#editPharmacyForm').find('[name="name"]').val(response.pharmacy.name).end()
                                                $('#editPharmacyForm').find('[name="password"]').val(response.pharmacy.password).end()
                                                $('#editPharmacyForm').find('[name="email"]').val(response.pharmacy.email).end()
                                                $('#editPharmacyForm').find('[name="address"]').val(response.pharmacy.address).end()
                                                $('#editPharmacyForm').find('[name="phone"]').val(response.pharmacy.phone).end()
                                            });

                                        });
                                    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>