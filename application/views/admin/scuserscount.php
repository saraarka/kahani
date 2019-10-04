<?php $this->load->view('admin/header.php'); ?>
<style>
.tagpagemaindiv {
  width: 90%;
  display: flex;
  flex-wrap: wrap;
  margin: 0 auto;
  justify-content: center;
}

.tagcards {
  width: 140px;
  text-align: center;
  border-radius: 5px;
  box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
  font-family: Arial, Helvetica, sans-serif;
  background: white;
  margin: 10px;
  box-sizing: border-box;
}

.tagtext {
  font-size: 18px;
  line-height: 50px;
  color: #5353ff;
  padding: 0px 5px;
  cursor: pointer;
  white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tagnumbertext {
  font-size: 12px;
  line-height: 30px;
  background: #efefef;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  color: #9d8f8f;
  padding: 0px 5px;
}

@media screen and (min-width: 1600px){
  .tagpagemaindiv {
     width: 75%;
  }
}

@media screen and (max-width: 620px){
  .tagpagemaindiv {
     width: 100%;
  }
}
</style>
  <div class="main">
    <h3>User Counts</h3>
    
    <h5>
        <span class="pull-right">
            <select class="form-control" onchange="scusercount(this.value);">
                <option value=""> -- By Language -- </option>
                <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language){ ?>
                <option value="<?php echo $language->code;?>"><?php echo $language->language;?> </option>
                <?php } } ?>
            </select>
        </span>
    </h5>
    <div class="">
        <h3>User Count Week, month, year</h3>
        <div class="tagpagemaindiv scusercount">
            <?php if(isset($uweek) && count($uweek > 0)){ ?>
                <?php foreach($uweek as $uweekrow) { ?>
                    <div class="tagcards">
                        <div class="tagtext"><a href="javascript:void(0);">Week</a></div>
                        <div class="tagnumbertext"><?php echo $uweekrow['pcount'];?></div>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php if(isset($umonth) && count($umonth > 0)){ ?>
                <?php foreach($umonth as $umonthrow) { ?>
                    <div class="tagcards">
                        <div class="tagtext"><a href="javascript:void(0);">Month</a></div>
                        <div class="tagnumbertext"><?php echo $umonthrow['pcount'];?></div>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php if(isset($uyear) && count($uyear > 0)){ ?>
                <?php foreach($uyear as $uyearrow) { ?>
                    <div class="tagcards">
                        <div class="tagtext"><a href="javascript:void(0);">Year</a></div>
                        <div class="tagnumbertext"><?php echo $uyearrow['pcount'];?></div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <?php if(isset($usergenre) && count($usergenre > 0)){ ?>
        <h3>Genre User Counts</h3>
          <div class="tagpagemaindiv">
              <?php foreach($usergenre as $ugenre) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);"><?php echo $ugenre['gener']; ?></a></div>
                      <div class="tagnumbertext"><?php echo $ugenre['gucount'];?></div>
                  </div>
              <?php } ?>
          </div>
      <?php } ?>

    </div>
    
  </div>
  <?php $this->load->view('admin/footer.php'); ?>