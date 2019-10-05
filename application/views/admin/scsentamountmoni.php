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
    <h3>Monitization Amount</h3>
      
      <?php if(isset($moniamount) && count($moniamount > 0)){ ?>
        <h3>Monitization Paid, Not Paid Amount</h3>
          <div class="tagpagemaindiv">
              <?php foreach($moniamount as $moniamountrow) { ?>
                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Paid Amount</a></div>
                      <div class="tagnumbertext"><?php echo $moniamountrow['paidamount'];?></div>
                  </div>

                  <div class="tagcards">
                      <div class="tagtext"><a href="javascript:void(0);">Not Paid Amount</a></div>
                      <div class="tagnumbertext"><?php echo $moniamountrow['tobepay'];?></div>
                  </div>
              <?php } ?>
          </div>
      <?php } ?>
    
  </div>