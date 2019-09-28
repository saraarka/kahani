    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
    	<h3> Send Webmail </h3>
	    <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/mailfromadmin" method="POST">

			<div class="form-group">
			    <label class="control-label col-sm-2" for="email">Email(s): </label>
			    <div class="col-sm-10">
			        <input type="text" name="email" class="form-control" placeholder="Enter Email( If you want to send more than one mail at a timeenter emails comma(,)  separation)" value="<?php echo set_value('email');?>">
			        <span class="text-danger"><?php echo form_error('email');?></span>
			    </div>
			</div>

			<div class="form-group">
			    <label class="control-label col-sm-2" for="subject">Subject: </label>
			    <div class="col-sm-10">
			        <input type="text" name="subject" class="form-control" placeholder="Enter mail subject" value="<?php echo set_value('subject');?>">
			        <span class="text-danger"><?php echo form_error('subject');?></span>
			    </div>
			</div>

			<div class="form-group">
			    <label class="control-label col-sm-2" for="message">Message: </label>
			    <div class="col-sm-10">
			        <textarea name="message" class="form-control" placeholder="Enter message"><?php echo set_value('message');?></textarea>
			        <span class="text-danger"><?php echo form_error('message');?></span>
			    </div>
			</div>

			<div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			        <button type="submit" class="btn btn-danger">Send</button>
			    </div>
			</div>

		</form>
    </div>

    <div class="main">
    	<h3> Sent Mail List </h3>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Sent To</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Sent On</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($sentmails) && ($sentmails->num_rows() > 0)){ $i = 1; foreach($sentmails->result() as $sentmailrow){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $sentmailrow->emails;?></td>
                        <td><?php echo $sentmailrow->subject;?></td>
                        <td><?php echo $sentmailrow->message;?></td>
                        <td><?php echo $sentmailrow->created_on;?></td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
<?php $this->load->view('admin/footer.php'); ?>
