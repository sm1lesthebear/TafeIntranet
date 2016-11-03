<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userchecks(3);



$outgoing_HTML = <<<HTML
<div class="col-sm-10 col-sm-offset-1">
  <h3>Upload A Document</h3>
</div>
<form action="Stakeholder_Details.php" method="post" enctype="multipart/form-data" class="margin-top" role="form">
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-1 margin-bottom">
      <label class="margin-top" for="file_upload">File to Upload : </label>
      <input required class="form-control btn btn-default" type="file" name="file_upload" id="file_upload">
    </div>
  </div>
  <div class="form-group">
           <div class="col-sm-5 col-sm-offset-1 margin-top" id="WHS" style="display: block;">
            <p>Work health and safety</p>
            <select class="form-control">
                <option id="x">Cancertroy</option>
                <option id="x">Succ</option>
                <option id="x">Ghey</option>
                <option id="x">Homophobia</option>
                <option id="x">IntGain</option>
                <option id="x">RIkiIsalive</option>
            </select>  
        </div>
        <div class="col-sm-5 col-sm-offset-1 margin-top" style="display: none;" id="SUS">
            <p>Sustainability</p>
            <select class="form-control">
                <option id="x">Aids</option>
                <option id="x">Succ</option>
                <option id="x">Ghey</option>
                <option id="x">Homophobia</option>
                <option id="x">IntGain</option>
                <option id="x">RIkiIsalive</option>
            </select>  
        </div>
        <div class="col-sm-2 margin-top">                            
            <div style="float: right;">
                <p>Toggle WHS/SUS</p>
                <input id="Sus_Whs_Dropdown" class="margin-bottom" type="checkbox" onClick="WHS_SUS_Check()">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-1 margin-top">
            <p>Doctype</p>
            <select class="form-control">
                <option id="x">Aids</option>
                <option id="x">Succ</option>
                <option id="x">Ghey</option>
                <option id="x">Homophobia</option>
                <option id="x">IntGain</option>
                <option id="x">RIkiIsalive</option>
            </select>  
        </div>
    </div>
</form>
<script>
  function WHS_SUS_Check()
  {
    if (document.getElementById("SUS").style.display == 'none')
    {
      document.getElementById("SUS").style.display = 'block';
      document.getElementById("WHS").style.display = 'none';
    } else 
    {
      document.getElementById("SUS").style.display = 'none';
      document.getElementById("WHS").style.display = 'block';
    }
  }
</script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();
?>

