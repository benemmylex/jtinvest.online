<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Options
            <small>Set up options</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-body table-responsive top-pad-3x bottom-pad-3x">
                        <?php echo form_open(base_url() . "admin/options-save"); ?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Referral bonus</label>
                                <input class="form-control" name="referral_bonus" type="number" value="5">
                            </div>
                            <div class="form-group">
                                <label>Bitcoin address</label>
                                <input class="form-control" name="btc_address" type="text" value="<?php echo $this->Util_model->get_option('btc_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Ethereum address</label>
                                <input class="form-control" name="eth_address" type="text" value="<?php echo $this->Util_model->get_option('eth_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>USDT address</label>
                                <input class="form-control" name="usdt_address" type="text" value="<?php echo $this->Util_model->get_option('usdt_address'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Perfect Money Account Number</label>
                                <input class="form-control" name="pm_account" type="text" value="<?php echo $this->Util_model->get_option('pm_account'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Bank name</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('bank_name') ?>" name="bank_name" >
                            </div>
                            <div class="form-group">
                                <label>Account number</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('account_name') ?>" name="account_name" >
                            </div>
                            <div class="form-group">
                                <label>Account name</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('account_number') ?>" name="account_number" >
                            </div>
                            <div class="form-group">
                                <label>Account type</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('account_type') ?>" name="account_type" >
                            </div>
                            <div class="form-group">
                                <label>Branch</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('branch') ?>" name="branch" >
                            </div>
                            <div class="form-group">
                                <label>Reference</label>
                                <input class="form-control" value="<?= $this->Util_model->get_option('reference') ?>" name="reference" >
                            </div>
                            <button class="btn btn-success btn-block" type="submit">Save Options</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
    </section>
</div>