<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userChecks(3);
$WHSDropdown = $Function_lib->getDropdown("select fldID, CONCAT(fldFirstName , ' ' , fldLastName) as StakeholderName from tbl_stakeholders", "fldID", "StakeholderName");
$SUSDropdown = $Function_lib->getDropdown("select fldID, CONCAT(fldFirstName , ' ' , fldLastName) as StakeholderName from tbl_stakeholders", "fldID", "StakeholderName");
$outgoing_HTML = <<<HTML
                    <form>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <p>Enter Search term(s)...</p>
                                <input required maxlength="45" type="text"  class="form-control" name="First_Name" id="First_Name" Placeholder="Enter Search term(s)...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-1 margin-top" id="WHS" style="display: block;">
                                <p>Work health and safety</p>
                                <select class="form-control">
                                    $WHSDropdown
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
                                    $SUSDropdown
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
                                    <input id="Sus_Whs_Dropdown" type="checkbox" onClick="WHS_SUS_Check()">
                                </div>
                            </div>
                            <div class="col-sm-2 margin-top">
                                <div style="float: right;">
                                    <p>Search all Projects</p>
                                    <input id="search_all_check" type="checkbox" onClick="Search_All()">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-1 margin-top">
                                <p>Doctype</p>
                                <select class="form-control">
                                    $SUSDropdown
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
                        function Search_All() 
                        {
                              var checkbox = document.getElementById("search_all_check");
                              var toggle1 = document.getElementById("SUS");
                              var toggle2 = document.getElementById("WHS");
                               
                              checkbox.checked ? toggle1.disabled = true : toggle1.disabled = false;
                              checkbox.checked ? toggle2.disabled = true : toggle2.disabled = false;
                             
                              return alert("functon being hit");
                        }
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