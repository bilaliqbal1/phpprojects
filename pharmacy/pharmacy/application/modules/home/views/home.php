<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    <section class="wrapper site-min-height">


        <?php
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $pharmacy_id = $this->db->get_where('pharmacy', array('ion_user_id' => $current_user_id))->row()->id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $pharmacy_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->pharmacy_id;
            }
        }
        ?>


        <!--state overview start-->
        <div class="col-md-12">
            <?php if (!$this->ion_auth->in_group('superadmin')) { ?>
                <?php if (!$this->ion_auth->in_group('Patient')) { ?>
                    <div class="row state-overview">
                        <div class="col-md-3 col-sm-6">
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <a href="finance/todaySales">
                                <?php } ?>
                                <section class="panel panel-moree">
                                    <div class="symbol terques">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div class="value">
                                        <p> <?php echo lang('today_sales'); ?> </p>
                                        <h1 class="">
                                            <?php echo $settings->currency; ?><?php echo $today_sales_amount; ?>
                                        </h1>
                                    </div>
                                </section>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                </a>
                            <?php } ?>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <a href="finance/todayExpense">
                                <?php } ?>
                                <section class="panel panel-moree">
                                    <div class="symbol blue">
                                        <i class="fa fa-minus"></i>
                                    </div>
                                    <div class="value">
                                        <p> <?php echo lang('today_expense'); ?> </p>
                                        <h1 class="">
                                            <?php echo $settings->currency; ?><?php echo $today_expenses_amount; ?>
                                        </h1>

                                    </div>
                                </section>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                </a>
                            <?php } ?>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <a href="medicine">
                                <?php } ?>
                                <section class="panel panel-moree">
                                    <div class="symbol blue">
                                        <i class="fa fa-medkit"></i>
                                    </div>
                                    <div class="value">
                                        <p> <?php echo lang('medicine'); ?> </p>
                                        <h1 class="">
                                            <?php
                                            echo $this->db
                                                    ->where('pharmacy_id', $pharmacy_id)
                                                    ->count_all_results('medicine');
                                            ?>
                                        </h1>

                                    </div>
                                </section>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                </a>
                            <?php } ?>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <a href="accountant">
                                <?php } ?>
                                <section class="panel panel-moree">
                                    <div class="symbol blue">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="value">
                                        <p> <?php echo lang('staff'); ?> </p>
                                        <h1 class="">
                                            <?php
                                            echo $this->db
                                                    ->where('pharmacy_id', $pharmacy_id)
                                                    ->count_all_results('accountant');
                                            ?>
                                        </h1>
                                    </div>
                                </section>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                </a>
                            <?php } ?>
                        </div>

                        <?php
                        foreach ($payments as $payment) {
                            $date = $payment->date;
                            $month = date('m', $date);
                            $year = date('y', $date);
                            if (date('y', time()) == date('y', $date)) {
                                if ($month == '01') {
                                    $jan[] = $payment->gross_total;
                                }
                                if ($month == '02') {
                                    $feb[] = $payment->gross_total;
                                }
                                if ($month == '03') {
                                    $mar[] = $payment->gross_total;
                                }
                                if ($month == '04') {
                                    $apr[] = $payment->gross_total;
                                }
                                if ($month == '05') {
                                    $may[] = $payment->gross_total;
                                }
                                if ($month == '06') {
                                    $jun[] = $payment->gross_total;
                                }
                                if ($month == '07') {
                                    $jul[] = $payment->gross_total;
                                }
                                if ($month == '08') {
                                    $aug[] = $payment->gross_total;
                                }
                                if ($month == '09') {
                                    $sep[] = $payment->gross_total;
                                }
                                if ($month == '10') {
                                    $oct[] = $payment->gross_total;
                                }
                                if ($month == '11') {
                                    $nov[] = $payment->gross_total;
                                }
                                if ($month == '12') {
                                    $dec[] = $payment->gross_total;
                                }
                            }
                        }
                        ?>

                        <div class="col-md-6">
                            <!--custom chart start-->
                            <div class="panel-heading"> <?php echo lang('sales_graph'); ?></div>
                            <div class="custom-bar-chart">
                                <ul class="y-axis">
                                    <li><span><?php echo $settings->currency; ?>1000000</span></li>
                                    <li><span><?php echo $settings->currency; ?>800000</span></li>
                                    <li><span><?php echo $settings->currency; ?>600000</span></li>
                                    <li><span><?php echo $settings->currency; ?>400000</span></li>
                                    <li><span><?php echo $settings->currency; ?>200000</span></li>
                                    <li><span><?php echo $settings->currency; ?>0</span></li>

                                </ul>
                                <div class="bar">
                                    <div class="title">JAN</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($jan)) {
                                        echo array_sum($jan);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($jan)) {
                                             echo 'height:' . array_sum($jan) * 100 / 1000000;
                                         }
                                         ?>"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">FEB</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($feb)) {
                                        echo array_sum($feb);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($feb)) {
                                             echo 'height:' . array_sum($feb) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">MAR</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($mar)) {
                                        echo array_sum($mar);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($mar)) {
                                             echo 'height:' . array_sum($mar) * 100 / 1000000;
                                         }
                                         ?>%"></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">APR</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($apr)) {
                                        echo array_sum($apr);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($apr)) {
                                             echo 'height:' . array_sum($apr) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar">
                                    <div class="title">MAY</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($may)) {
                                        echo array_sum($may);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($may)) {
                                             echo 'height:' . array_sum($may) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">JUN</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($jun)) {
                                        echo array_sum($jun);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($jun)) {
                                             echo 'height:' . array_sum($jun) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar">
                                    <div class="title">JUL</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($jul)) {
                                        echo array_sum($jul);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($jul)) {
                                             echo 'height:' . array_sum($jul) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">AUG</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($aug)) {
                                        echo array_sum($aug);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($aug)) {
                                             echo 'height:' . array_sum($aug) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">SEP</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($sep)) {
                                        echo array_sum($sep);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($sep)) {
                                             echo 'height:' . array_sum($sep) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">OCT</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($oct)) {
                                        echo array_sum($oct);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($oct)) {
                                             echo 'height:' . array_sum($oct) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">NOV</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($nov)) {
                                        echo array_sum($nov);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($nov)) {
                                             echo 'height:' . array_sum($nov) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                                <div class="bar ">
                                    <div class="title">DEC</div>
                                    <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                                    if (!empty($dec)) {
                                        echo array_sum($dec);
                                    }
                                    ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                         if (!empty($dec)) {
                                             echo 'height:' . array_sum($dec) * 100 / 1000000;
                                         }
                                         ?>%""></div>
                                </div>
                            </div>
                            <!--custom chart end-->
                        </div>

                        <div class="col-md-6">
                            <!--work progress start-->
                            <section class="panel">
                                <div class="panel-body progress-panel">
                                    <div class="task-progress">
                                        <h1>Statistic</h1>
                                        <p>This Month</p>
                                    </div>
                                </div>
                                <table class="table table-hover personal-task">
                                    <tbody>  
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <?php echo lang('number_of_sales'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-important">
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_n_o_s = $this->db->get('payment')->result();
                                                    $i = 0;
                                                    foreach ($query_n_o_s as $q_n_o_s) {
                                                        if (date('m', time()) == date('m', $q_n_o_s->date)) {
                                                            $i = $i + 1;
                                                        }
                                                    }
                                                    echo $i;
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress1"><canvas width="47" height="20" style="display: inline-block; width: 47px; height: 20px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <?php echo lang('total_sales'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-important">
                                                    <?php echo $settings->currency; ?>
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query = $this->db->get('payment')->result();
                                                    $sales_total = array();
                                                    foreach ($query as $q) {
                                                        if (date('m', time()) == date('m', $q->date)) {
                                                            $sales_total[] = $q->gross_total;
                                                        }
                                                    }
                                                    if (!empty($sales_total)) {
                                                        echo array_sum($sales_total);
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress1"><canvas width="47" height="20" style="display: inline-block; width: 47px; height: 20px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <?php echo lang('number_of_expenses'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_n_o_e = $this->db->get('expense')->result();
                                                    $i = 0;
                                                    foreach ($query_n_o_e as $q_n_o_e) {
                                                        if (date('m', time()) == date('m', $q_n_o_e->date)) {
                                                            $i = $i + 1;
                                                        }
                                                    }
                                                    echo $i;
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress2"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <?php echo lang('total_expense'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <?php echo $settings->currency; ?>
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_expense = $this->db->get('expense')->result();
                                                    $sales_total = array();
                                                    foreach ($query_expense as $q_expense) {
                                                        if (date('m', time()) == date('m', $q_expense->date)) {
                                                            $expense_total[] = $q_expense->amount;
                                                        }
                                                    }
                                                    if (!empty($expense_total)) {
                                                        echo array_sum($expense_total);
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress2"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <?php echo lang('medicine_number'); ?> 
                                            </td>
                                            <td>
                                                <span class="badge bg-info"> 
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_medicine_number = $this->db->get('medicine')->result();
                                                    $i = 0;
                                                    foreach ($query_medicine_number as $q_medicine_number) {
                                                        $i = $i + 1;
                                                    }
                                                    echo $i;
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress3"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <?php echo lang('medicine_quantity'); ?> 
                                            </td>
                                            <td>
                                                <span class="badge bg-info"> 
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_medicine = $this->db->get('medicine')->result();
                                                    $i = 0;
                                                    foreach ($query_medicine as $q_medicine) {
                                                        if ($q_medicine->quantity > 0) {
                                                            $i = $i + $q_medicine->quantity;
                                                        }
                                                    }

                                                    echo $i;
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress3"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>
                                                <?php echo lang('medicine_o_s'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">
                                                    <?php
                                                    $this->db->where('pharmacy_id', $pharmacy_id);
                                                    $query_medicine = $this->db->get('medicine')->result();
                                                    $i = 0;
                                                    foreach ($query_medicine as $q_medicine) {
                                                        if ($q_medicine->quantity == 0) {
                                                            $i = $i + 1;
                                                        }
                                                    }
                                                    echo $i;
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress4"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>
                                        <!--
                                        <tr>
                                            <td>8</td>
                                            <td>
                                        <?php echo lang('discount'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">



                                        <?php echo $settings->currency; ?>

                                        <?php
                                        $query_discount = $this->db->get('payment')->result();
                                        $discount_total = array();
                                        foreach ($query_discount as $q_discount) {
                                            if (date('m', time()) == date('m', $q_discount->date)) {
                                                $discount_total[] = $q_discount->discount;
                                            }
                                        }

                                        if (!empty($discount_total)) {
                                            echo array_sum($discount_total);
                                        }
                                        ?>

                                                </span>
                                            </td>
                                            <td>
                                                <div id="work-progress5"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                            </td>
                                        </tr>
                                        -->
                                    </tbody>
                                </table>
                            </section>
                            <!--work progress end-->
                        </div>


                        <div class="col-md-6">         
                            <div class="panel-heading"> <?php echo lang('latest_sales'); ?></div>
                            <table class="table table-striped table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('grand_total'); ?> </th>
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
                                    .option_th{
                                        width:18%;
                                    }

                                </style>
                                <?php
                                $i = 0;
                                foreach ($payments as $payment) {
                                    $i = $i + 1;
                                    ?>
                                    <?php $client_info = $this->db->get_where('client', array('id' => $payment->client))->row(); ?>
                                    <tr class="">
                                        <td><?php echo date('d/m/y', $payment->date); ?></td>
                                        <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                    </tr>
                                    <?php
                                    if ($i == 10)
                                        break;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-6">         
                            <div class="panel-heading"> <?php echo lang('latest_expense'); ?></div>
                            <table class="table table-striped table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('category'); ?> </th>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
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
                                <?php
                                $i = 0;
                                foreach ($expenses as $expense) {
                                    $i = $i + 1;
                                    ?>
                                    <tr class="">
                                        <td><?php echo $expense->category; ?></td>
                                        <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                        <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>             
                                    </tr>
                                    <?php
                                    if ($i == 10)
                                        break;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">  
                            <div class="panel-heading"> <?php echo lang('latest_medicines'); ?></div>
                            <table class="table table-striped table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('name'); ?></th>
                                        <th> <?php echo lang('category'); ?></th>
                                        <th> <?php echo lang('price'); ?></th>
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

                                    .load{
                                        float: right !important;
                                    }

                                </style>
                                <?php
                                $i = 0;
                                foreach ($medicines as $medicine) {
                                    $i = $i + 1;
                                    ?>
                                    <tr class="">
                                        <td><?php echo $medicine->name; ?></td>
                                        <td> <?php echo $medicine->category; ?></td>
                                        <td><?php echo $settings->currency; ?> <?php echo $medicine->s_price; ?></td>
                                    </tr>
                                    <?php
                                    if ($i == 10)
                                        break;
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>

                        <aside class="col-md-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <div id="calendar" class="has-toolbar"></div>
                                </div>
                            </section>
                        </aside>
                    </div>

                <?php } ?>
            <?php }else { ?>

                <section class="col-md-12">
                    <div class="col-md-6 col-sm-6">
                        <h1>Pharmacy</h1>
                    </div>
                </section>
                <?php foreach ($pharmacys as $pharmacy) { ?>    
                    <div class="col-md-6 col-sm-6">
                        <section class="panel">
                            <div class="symbol terques super">
                                <?php echo $pharmacy->name; ?>
                            </div>
                            <div class="value"> 
                                <p class="">
                                    Email:   <?php echo $pharmacy->email; ?>
                                </p>
                                <p class="">
                                    Address:   <?php echo $pharmacy->address; ?>
                                </p>
                                <p class="">
                                    Phone:  <?php echo $pharmacy->phone; ?>
                                </p>
                            </div>
                        </section>
                    </div>
                <?php } ?>

            <?php } ?>


        </div>
        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->

</body>
</html>
