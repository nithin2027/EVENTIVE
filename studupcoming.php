<?php
session_start();
include ('db_conn.php');
include ('include/head.php');
?>
<title>Student Upcoming</title>
<link rel="stylesheet" href="css/upcoming2.css" type="text/css">
</head>
    <?php
    include ('include/stud.php');
    include ('include/logo.php');
    ?>
      <div class= "title">Upcoming Events</div>
      <div class="main">
        <ul class="cards">
        <?php
        $username = $_SESSION['usern'];
        $sql = "SELECT * FROM event_details WHERE event_name IN(SELECT event_name FROM participants WHERE username='$username')";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) > 0){
            while($event_details = mysqli_fetch_assoc($res)) {
                  $s = explode(" ",$event_details['date_time']);
                  if((strtotime($s[0])) >= (strtotime(date("d-m-Y")))){
                ?>
          <li class="cards_item">
            <div class="card">
              <div class="card_image"><img src="uploads/<?php echo $event_details['poster'];?>"><div class="card_label"><?=$event_details['event_name']?></div></div>
              <div class="card_content">
                <p class="card_text"><?=$event_details['event_desc']?></p>
                <div class="maincontent">
                  <div class="date">Date: <br>
                    <?php
                    echo date("d-m-Y",strtotime($s[0]));
                    ?>
                  </div>
                  <div class="venue">Venue: <?=$event_details['event_venue']?></div>
                  <div class="time">Time: 
                    <?php
                    echo date("g:ia",strtotime($s[1]));
                    ?>
                  </div>
                </div>
                <button class="btn card_btn"><a href="registration.php">Register</a></button>
                <button class="btn card_btn"><a href = "#" class = "card-link" data-toggle = "modal" data-target = "#modalId">Read More</a></button>
              </div>
            </div>
          </li>
          <?php
         }
          else {?>
            <div style = "text-align:center;margin:50px;">
                <h2 style = "font-family: 'Poppins',sans-serif;color:rgb(100,100,100);">You Haven't Registered For Any Of The Ongoing Events</h2>
            </div>
            <?php }
        } }
         else {?>
        <div style = "text-align:center;margin:50px;">
            <h2 style = "font-family: 'Poppins',sans-serif;color:rgb(100,100,100);">You Haven't Registered For Any Of The Ongoing Events</h2>
        </div>
        <?php }?>
        </ul>
  </div>
</div>
<?php
include ('include/modal.php');
?>
            <hr>
            <button class="btn2 mt-2" style="width: 15%;color:var(--link-color);height: 40px;position:relative;top: 0px;left: 22rem;background-color: var(--header-color);border-radius: 15px;border: red;margin-top: 20px;"><a href="registration.php">Register</a></button>
        </div>
        </div>
    </div>
</div>
<script src="js/alert.js"></script>
</body>
<script src="js/modal.js"></script>
<?php
include ('include/footer.php');
?>