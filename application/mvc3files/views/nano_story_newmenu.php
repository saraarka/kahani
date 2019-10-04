<link rel="stylesheet" href="<?php echo base_url();?>assets/css/nanostory.css">

<form action="<?php echo base_url('nano_insert');?>" method="post" id="nanostory">
    <div class="navbar navbar-inverse navbar-static-top contentseries" role="navigation" id="" style="margin-bottom:0px;  background-color:#23678e;"> 
      <div class="navbar-collapse">
        <ul class="nav navbar-nav pull-right">
          <li class="">
              <button class="btn btn-warning" type="submit" style="background:none; color:#FFF;font:bold;border-color: #3c8dbc;margin-top:8.5px;" id="naveen" onclick="submit()"> PUBLISH </button> 
          </li>
          <li class="">
              <a href="<?php echo base_url();?>write-nano" class="" style="background:none;color:#FFF;font:bold;border-color:#3c8dbc;"> CANCEL </a>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="tops">
      <section class="content contentseries">
        <div class="main-container">
            <div class="">
              <div class="">
                  <div class="box box-widget widget-user boxshv" style="padding:25px;"><br>
                  <div class="row"> 
                    <label for="" class="col-sm-3 control-label" style="padding-top:8px;">Select Language :</label>
                <input type="hidden" id="previousenlang">
                <?php $sesslang = get_langshortname($this->uri->segment(1)); ?>
                <input type="hidden" id="languageto" value="<?php echo $sesslang;?>">
                <input type="hidden" id="checkboxId" checked="checked">
                <div class="col-sm-9">
                    <select class="form-control" name="language" required="" id="languageDropDown" onchange="javascript:languageChangeHandler()">
                    <option value=""> Select Language </option>
                    <?php if(isset($languages) && ($languages->num_rows() > 0)){ foreach($languages->result() as $key) { ?>
                    <option value="<?php echo $key->code; ?>" <?php if($key->code == $sesslang){ echo 'selected';} ?>><?php echo $key->language; ?></option>
                    <?php } } ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('language');?></span> 
                </div>
                    <div class="box-body pad">
                        <span class="pull-left">
                                   <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle" style="margin-top: 9px;"></i></a>
                                    &nbsp; &nbsp;
                                </span>
                                <h6 class="pull-left" id="count_message"></h6>
                      <textarea name="story" id="story" rows="15" cols="96" required="" class="form-control" placeholder="Start Writing Here...." maxlength="1000" minlength="1" style="resize:none;"><?php echo set_value('story');?></textarea>
                      <span class="text-danger"><?php echo form_error('story');?></span>
                    </div>
                    </div>
                </div>
              </div>
             </div>
        </div>
      </section>
      <section class="content contentseries1">
        <div class="" style="text-align:center;">
            <h3>TO START WRITING</h3><br>
            INSTALL OUR APP<br>
            <a href=""><img src="<?php echo base_url();?>assets/landing/storycarry app.png" class="img-thumbnaile"></a><br>
            Or<br>
            OPEN SITE ON DESKTOP
        </div>
    </section>
    </div>
</form>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  var text_max = 1000;
  $('#count_message').html(text_max + ' Remaining');
  $('#story').keyup(function() {
    var text_length = $('#story').val().length;
    var text_remaining = text_max - text_length;
    $('#count_message').html(text_remaining + ' Remaining');
  });
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    // Load the Google Transliterate API
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var languageto = document.getElementById("languageto").value;
    var transliterationControl;
    var oldValue = $('select#languageDropDown option:selected').val();
    function onLoad() {
        if(languageto == 'en'){
            document.getElementById("previousenlang").value = 'en';
            var options = {
                sourceLanguage: 'en',
                destinationLanguage: ['te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],
                transliterationEnabled: false,
            };
        }else{
            var options = {
                sourceLanguage: 'en',
                destinationLanguage: [languageto,'te','hi','ml','ta','bn','gu','kn','mr','ru','pa','or'],
                transliterationEnabled: true,
            };
        }
        // Create an instance on TransliterationControl with the required // options.
        transliterationControl = new google.elements.transliteration.TransliterationControl(options);
        // Enable transliteration in the textfields with the given ids.
        var ids = [ "story" ];
        transliterationControl.makeTransliteratable(ids);
        transliterationControl.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';  // https ssl activation
        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);
        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE, serverUnreachableHandler);
        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE, serverReachableHandler);
        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked = transliterationControl.isTransliterationEnabled();
        // Populate the language dropdown
        var destinationLanguage = transliterationControl.getLanguagePair().destinationLanguage;
    }
    // Handler for STATE_CHANGED event which makes sure checkbox status
    // reflects the transliteration enabled or disabled status.
    function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
    }
    // Handler for dropdown option change event.  Calls setLanguagePair to
    // set the new language.
    function languageChangeHandler() {
        var storytext = document.getElementById("story").value;
        if(storytext){
            //var answer = confirm("The content you have written will be cleared if you switch language.");
            //if(answer) {  // confirm message language change entered story remove
            $('.deletemessage').html('The content you have written will be cleared if you switch language.');
            $('#confirmdelpopup').modal().one('click', '#delconfirmed', function (e) {
                var dropdown = document.getElementById('languageDropDown');
                document.getElementById("story").value = '';
                document.getElementById("count_message").innerHTML = '1000 Remaining';
                var previousenlang = document.getElementById("previousenlang").value;
                if(dropdown.options[dropdown.selectedIndex].value == 'en'){
                    document.getElementById("previousenlang").value = 'en';
                    transliterationControl.toggleTransliteration();
                }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
                    transliterationControl.toggleTransliteration();
                    document.getElementById("previousenlang").value = '';
                    transliterationControl.setLanguagePair(
                    google.elements.transliteration.LanguageCode.ENGLISH,
                    dropdown.options[dropdown.selectedIndex].value);
                }else{
                    transliterationControl.setLanguagePair(
                    google.elements.transliteration.LanguageCode.ENGLISH,
                    dropdown.options[dropdown.selectedIndex].value);
                }
                oldValue = dropdown.options[dropdown.selectedIndex].value;
            });
            $('#confirmdelpopup').modal().one('click', '.delcancelled', function (e) {
                document.getElementById('languageDropDown').value = oldValue;
            });
        }else{
            var dropdown = document.getElementById('languageDropDown');
            document.getElementById("story").value = '';
            var previousenlang = document.getElementById("previousenlang").value;
            if(dropdown.options[dropdown.selectedIndex].value == 'en'){
                document.getElementById("previousenlang").value = 'en';
                transliterationControl.toggleTransliteration();
            }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
                transliterationControl.toggleTransliteration();
                document.getElementById("previousenlang").value = '';
                transliterationControl.setLanguagePair(
                google.elements.transliteration.LanguageCode.ENGLISH,
                dropdown.options[dropdown.selectedIndex].value);
            }else{
                transliterationControl.setLanguagePair(
                google.elements.transliteration.LanguageCode.ENGLISH,
                dropdown.options[dropdown.selectedIndex].value);
            }
        }
        
        /*var dropdown = document.getElementById('languageDropDown');
        document.getElementById("story").value = '';
        var previousenlang = document.getElementById("previousenlang").value;
        if(dropdown.options[dropdown.selectedIndex].value == 'en'){
            document.getElementById("previousenlang").value = 'en';
            transliterationControl.toggleTransliteration();
        }else if(previousenlang == 'en' && dropdown.options[dropdown.selectedIndex].value != 'en'){
            transliterationControl.toggleTransliteration();
            document.getElementById("previousenlang").value = '';
            transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
        }else{
            transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
        }*/
    }
    // SERVER_UNREACHABLE event handler which displays the error message.
    function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "Transliteration Server unreachable";
    }
    // SERVER_UNREACHABLE event handler which clears the error message.
    function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
    }
    google.setOnLoadCallback(onLoad);
</script>

<script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>