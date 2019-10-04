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
    <h3>New Stories week , month, year Counts </h3>
    
    <h5>
        <span class="pull-right">
            <select class="form-control" onchange="scstorieswmy(this.value);">
                <option value=""> -- By Language -- </option>
                <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language){ ?>
                <option value="<?php echo $language->code;?>"><?php echo $language->language;?> </option>
                <?php } } ?>
            </select>
        </span>
    </h5>
    <div class="scstorieswmy">
        <h3>New Series Counts</h3>
        <div class="tagpagemaindiv serieswmy">
          <?php if(isset($seweek) && count($seweek > 0)){ ?>
              <?php foreach($seweek as $seweekrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Week</a></div>
                      <div class="tagnumbertext"><?php echo $seweekrow['secount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($semonth) && count($semonth > 0)){ ?>
              <?php foreach($semonth as $semonthrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Month</a></div>
                      <div class="tagnumbertext"><?php echo $semonthrow['secount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($seyear) && count($seyear > 0)){ ?>
              <?php foreach($seyear as $seyearrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Year</a></div>
                      <div class="tagnumbertext"><?php echo $seyearrow['secount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>
        </div>

        <br>
        <h3>New Stories Counts</h3>
        <div class="tagpagemaindiv storieswmy">
          <?php if(isset($sweek) && count($sweek > 0)){ ?>
              <?php foreach($sweek as $sweekrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Week</a></div>
                      <div class="tagnumbertext"><?php echo $sweekrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($smonth) && count($smonth > 0)){ ?>
              <?php foreach($smonth as $smonthrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Month</a></div>
                      <div class="tagnumbertext"><?php echo $smonthrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($syear) && count($syear > 0)){ ?>
              <?php foreach($syear as $syearrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Year</a></div>
                      <div class="tagnumbertext"><?php echo $syearrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>
        </div>

        <br>
        <h3>New Life Events Counts</h3>
        <div class="tagpagemaindiv lifewmy">
          <?php if(isset($lweek) && count($lweek > 0)){ ?>
              <?php foreach($lweek as $lweekrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Week</a></div>
                      <div class="tagnumbertext"><?php echo $lweekrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($lmonth) && count($lmonth > 0)){ ?>
              <?php foreach($lmonth as $lmonthrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Month</a></div>
                      <div class="tagnumbertext"><?php echo $lmonthrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($lyear) && count($lyear > 0)){ ?>
              <?php foreach($lyear as $lyearrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Year</a></div>
                      <div class="tagnumbertext"><?php echo $lyearrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>
        </div>

        <br>
        <h3>New Nano Stories Counts</h3>
        <div class="tagpagemaindiv nanowmy">
          <?php if(isset($nweek) && count($nweek > 0)){ ?>
              <?php foreach($nweek as $nweekrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Week</a></div>
                      <div class="tagnumbertext"><?php echo $nweekrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($nmonth) && count($nmonth > 0)){ ?>
              <?php foreach($nmonth as $nmonthrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Month</a></div>
                      <div class="tagnumbertext"><?php echo $nmonthrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>

          <?php if(isset($nyear) && count($nyear > 0)){ ?>
              <?php foreach($nyear as $nyearrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Year</a></div>
                      <div class="tagnumbertext"><?php echo $nyearrow['scount'];?></div>
                  </div>
              <?php } ?>
          <?php } ?>
        </div>

    </div>
    
  </div>
  <?php $this->load->view('admin/footer.php'); ?>