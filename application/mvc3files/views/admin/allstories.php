    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <h3> Analytics </h3>
        
        <div class="row">
            <div class="col-md-6">
                <?php if(isset($allstories) && !empty($allstories)){ ?>
                <h4>All Stories Count</h4>
                <table class="table table-condensed table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <?php } ?>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
    