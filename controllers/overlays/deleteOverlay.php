<?php require "../../controllers/includes/common.php";
 ?>

    <!-- overlay code start -->
    <div class="overlay" id="overlay"> 
        <div class="overlay-window">
            <div class="overlay-window-titlebar">
                <span class="overlay-title">Confirm Delete</span>
                <button class="close material-icons" onclick="document.getElementById('overlay').style.display='none'">close</button>
            </div>
            <div class="overlay-content" style="color:black;text-align:center">
                This action cannot be un-done<br><br>
                    <div class="table-footer pa4">
                        <!-- <form> -->
                            <div class="fl w-75 tl">
                                <Button class="btn btn-warning"  onclick="document.getElementById('del_response').submit();document.getElementById('overlay').style.display='none'">Yes,Delete</Button>
                            </div>
                        <!-- </form> -->
                        <div class="fl w-25 tr">
                            <Button class="btn btn-secondary" onclick="document.getElementById('overlay').style.display='none'">No,Cancel</Button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- overlay end -->

    <!-- action="../../controllers/employee_controller.php?del= + <?php //echo $row['emp_code']; ?>" -->
