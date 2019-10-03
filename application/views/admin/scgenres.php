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
    <h3>Genre Counts </h3>
    
    <h5>
        <span class="pull-right" id="storiessearch">
            <select class="form-control" onchange="scgenres(this.value);">
                <option value=""> -- By Language -- </option>
                <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $language){ ?>
                <option value="<?php echo $language->code;?>"><?php echo $language->language;?> </option>
                <?php } } ?>
            </select>
        </span>
    </h5>
    <div class="scgenreslang">
        <?php if(isset($stories) && count($stories > 0)){ ?>
          <h3>All Stories Genre Counts</h3>
            <div class="tagpagemaindiv">
                <?php foreach($stories as $story) { ?>
                    <div class="tagcards">
                        <div class="tagtext"><a href="javascript:void(0);"><?php echo $story['gener']; ?></a></div>
                        <div class="tagnumbertext"><?php echo $story['storiescount'];?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if(isset($series) && count($series > 0)){ ?>
          <h3>All Series Genre Counts</h3>
            <div class="tagpagemaindiv">
                <?php foreach($series as $seriesrow) { ?>
                    <div class="tagcards">
                        <div class="tagtext"><a href="javascript:void(0);"><?php echo $seriesrow['gener']; ?></a></div>
                        <div class="tagnumbertext"><?php echo $seriesrow['storiescount'];?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
  </div>
  <?php $this->load->view('admin/footer.php'); ?>