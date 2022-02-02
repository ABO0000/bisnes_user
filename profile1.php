<?php 
    session_start();
    require_once 'fbconfig.php';
    require_once 'login.php';

  $bisnesesClass = new Bisness;
  $bisneses = $bisnesesClass->connect()->query("SELECT * FROM `bisneses` ")->fetch_all(MYSQLI_ASSOC) ;

  // print_r($paymanavorvacutyunner);
?>
<!DOCTYPE html>
<html lang="en">  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylee.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <meta charset="utf-8">
    <style>
        .ui.popup{
          width: 18em;
          height: 18em;
        }

        .ui.calendar .ui.table.day{
          width: 18em;
        }
      .calendar{
        color: #fff;
        margin: 40px auto;
        background: gray;
        padding: 60px 40px 80px 40px;
        width: 95%;
        max-width: 1000px;
        height: 600px;
        border-radius: 5px;
        box-shadow: 0px 2px 6px rgba(2,2,2,0.2);
        position: relative;
      }
      .calendar__title{
        text-align: center;
      }
      .calendar--day-view{
        position: absolute;
        border-radius: 3px;
        top: -2.5%;
        left: -2.5%;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,1);
      box-shadow: 3px 12px 5px rgba(2,2,2,0.16);
        z-index: 2;
        overflow: hidden;
        transform: scale(0.9) translate(30px,30px);
        opacity: 0;
        visibility: hidden;
      /*   border-radius: 5px; */
        display: none;
        align-items: flex-start;
        flex-wrap: wrap;
      }
      .day-view-content{
        color: #222;
        width: 100%;
        padding-top: 55px;
      }
      .day-highlight, .day-add-event{
        padding: 8px 10px;
        margin: 12px 15px;
        border-radius: 4px;
        background: #e7e8e8;
        color: #222;
        font-size: 14px;
        font-weight: 600;
        font-family: "Avenir", sans-serif;
      }
      .row{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
      }
      .row .qtr{
        width: 40%;
      }
      .row .half{
        width: 100%;
      }
      @media (min-width: 800px){
        .row{
          flex-wrap: nowrap;
        }
        .row .half{
          width: 35%;
        }
        .row .qtr{
          width: 25%;
        }
      }

      .day-add-event{
        background: #04b6e2;
        color: #fff;
        padding: 16px;
        display: none;
        transform: translateY(-15px);
        opacity: 0;
      }
      .day-add-event[data-active="true"]{
        display: block;
        animation: popIn 250ms 1 forwards;
      }
      .add-event-label{
        padding: 10px 0;
        font-size: 18px;
        font-family: 'Avenir', sans-serif;
        color: #fff;
        font-weight: 400;
        font-size: 12px;
        color: rgba(255,255,255,0.8);
      }
      .add-event-edit{
        display: block;
        margin: 4px 0;
        max-width: 70%;
        border-bottom: 2px solid #fff;
        font-size: 18px;
        font-weight: 800;
        color: #fff;
      }
      .add-event-edit--long{
        max-width: 90%;
      }

      input.add-event-edit{
        border: none;
        border-bottom: 2px solid #fff;
        background: transparent;
        outline: none;
        font: inherit;
        color: #fff;
        font-size: 18px;
        font-weight: 800;
      }
      .add-event-edit--error, input.add-event-edit--error{
        border-color: #ff5151;
        animation: shake 300ms 1 forwards;
      }
      @keyframes shake {
        20%, 60%{
          transform: translateX(4px);
        }
        40%, 80%{
          transform: translateX(-4px);
        }
      }
      input.add-event-edit::-webkit-input-placeholder {
        color: #fff;
      }

      input.add-event-edit:-moz-placeholder { /* Firefox 18- */
        color: #fff;  
      }

      input.add-event-edit::-moz-placeholder {  /* Firefox 19+ */
        color: #fff;  
      }

      input.add-event-edit:-ms-input-placeholder {  
        color: #fff;  
      }
      .event-btn{
        padding: 3px 8px;
        border: 3px solid #fff;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        width: 65px;
        margin: 5px 0;
        text-align: center;
      }

      .event-btn--save{
        border-color: #fff;
        background: #74c500;
        color: #fff;
        border-color: transparent;
      }
      .event-btn--save:hover{
        box-shadow: 0px 2px 4px rgba(2,2,2,0.2);
      }
      .event-btn--cancel{
        background: #ff5151;
        color: #fff;
        border-color: transparent;
      }
      .event-btn--cancel:hover{
        box-shadow: 0px 2px 4px rgba(2,2,2,0.2);
      }
      /* .add-event-btn:hover, .add.event-btn:focus{
        background: #00258e;
        box-shadow: 0px -1px 2px rgba(3,2,2,0.2);
      } */
      .day-highlight .day-events-link{
        border-bottom: 2px solid #222;
        padding: 0;
        cursor: pointer;
      }
      #add-event{
        color: #04b6e2;
        border-color: #04b6e2;
      }
      .day-view-exit{
        position: absolute;
        top: 24px;
        line-height: 1em;
        left: 22px;
        font-size: 22px;
        color: #252525;
        font-family: 'Avenir', sans-serif;
        font-weight: 800;
        cursor: pointer;
        opacity: 0;
        animation: popIn 200ms 1 forwards;
        text-transform: uppercase;
      }
      .day-view-date{
        position: absolute;
        top: 19px;
        right: 22px;
        text-align: right;
        font-size: 22px;
        font-family: 'Avenir', sans-serif;
        font-weight: 800;
        color: #393939;
        border-bottom: 2px solid #222;
        cursor: pointer;
      }
      .day-inspiration-quote{
        position: absolute;
        top: 90px;
        margin-top: -10px;
        /* left: 10%; */
        width: 100%;
        height: calc(100% - 110px);
        /* display: flex;
        flex-wrap: nowrap;
        align-items: center; */
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -1px;
        color: #ddd;
        line-height: 1.1em;
        font-family: 'Avenir', sans-serif;
        z-index: -1;
      }
      .day-event-list-ul{
        list-style: none;
        margin: auto;
        width: 95%;
        padding: 0;
        max-height: 300px;
        overflow: auto;
      }
      .day-event-list-ul li {
        padding: 10px;
        margin: 10px 0;
      /*   background: #04b6e2; */
      /*   box-shadow: 0px 1px 1px  rgba(2,2,2,0.5); */
        position: relative;
      }
      .event-dates small{
        font-size: 0.65em;
        color: #444;
      }
      .event-dates{
        font-weight: 800;
        font-family: 'Avenir', sans-serif;
        color: #04b6e2;
        font-size: 18px;
        text-transform: lowercase;
      /*   position: relative; */
      }
      .event-delete{
        position: absolute;
        right: 10px;
        top: 0px;
        font-size: 12px;
        color: #f25656;
        cursor: pointer;
      }
      .event-name{
        font-size: 19px;
        font-family: 'Avenir', sans-serif;
        color: #222;
        padding:10px;
        background: #f7f7f7;
        margin: 2px 0;
        display: block;
        text-transform: initial;
      }
      .calendar--day-view-active{
        animation: popIn 200ms 1 forwards;
        visibility: visible;
        display: flex;
        transition: visibility 0ms;

      }
      .calendar--view{
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        width: 100%;
      }
      .cview__month{
        width: 100%;
        text-align: center;
        font-weight: 800;
        font-size: 22px;
        font-family: 'Avenir', sans-serif;
        padding-bottom: 20px;
        color: #222;
        text-transform: uppercase;
        display: flex;
        flex-wrap: nowrap;
        align-items: baseline;
        justify-content: space-around;
      }
      .cview__month-last,.cview__month-next,.cview__month-current{
        width: 33.33333%;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        color: #222;
      }
      .cview__month-last:hover,.cview__month-next:hover{
        color: #fff;
      }

      .cview__month-current{
        font-size: 22px;
        cursor: default;
        animation: popIn 200ms 1 forwards;
        transform: translateY(20px);
        opacity: 0;
        position: relative;
      }
      .cview__month-reset{
        animation: none;
      }
      .cview__month-activate{
        animation: popIn 100ms 1 forwards;
      }
      .cview--spacer, .cview__header, .cview--date{
        width: 14.28571428571429%;
        max-width: 14.28571428571429%;
        padding: 10px;
        box-sizing: border-box;
        position: relative;
        text-align: center;
        overflow: hidden;
        text-overflow: clip;
        font-size: 14px;
        font-weight: 900;
      }
      .cview--date{
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;
      }
      .has-events::after{
        border-radius:100%;
        animation: popIn 200ms 1 forwards;
        background: rgba(255,255,255,0.95);
        transform: scale(0);
        content: '';
        display: block;
        position: absolute;
        width: 8px;
        height: 8px;
        top: 8px;
        left: 12px;
        
      }
      .cview--date:hover::before{
        background: rgba(255,255,255,0.2);
      }
      .cview--date.today{
        color: #111;  
      }
      .cview--date.today::before{
        animation: popIn 200ms 1 forwards;
        background: rgba(255,255,255,0.2);
        transform: scale(0);
      }
      @keyframes popIn{

        100%{
          transform: scale(1);
          opacity: 1;
        }
      }
      .cview--date::before{
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: '';
        transform: scale(0.8);
        z-index: 0;
      }
      .footer{
        width: 100%;
        bottom: 50px;
        left: 0;
        position: absolute;
        font-size: 14px;
        text-align: center;
      }
      .footer__link{
        cursor: pointer;
        padding: 2px 5px;
        border-bottom: 1px solid #fff;
      }

    </style>
  </head>
  <body style="background: #dcdee1">
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><h3>Profile</h3></a>
      <div style="color: white; margin-bottom:18px; display:flex; justify-content:center;align-items:center">
        <?php if(isset($_SESSION['access_token'])){?>
            <div class="container mt-4">
                <?php echo "Hello " . $user->getField('name') ?>
                <a href="logout.php">Logout</a>
            </div>
        <?php }else if(isset($_SESSION['user'])){?>
            <div class="container mt-4" >
                <?php echo $_SESSION['user'][0]['name'] .' '. $_SESSION['user'][0]['surname'] ?>
                <a href="logout.php" style="color: white;margin-left:20px">Logout</a>
            </div>
        <?php }?>
      </div>
    </nav>
    
    <div style="display: flex;justify-content:center ;max-height: 90vh;">
      <!-- <h1>ok</h1> -->
    


      <div style="width:252px;height:90vh;background-color: gray;border:2px solid gray;margin-top:2px">
        <div style="display:flex;justify-content:center;align-items:center;height: 60px;">
          <h2 style="color: white;">Bisneses</h2>
        </div>
        <div style="overflow-y:scroll;width: 250px;height: 82vh;">
          <?php foreach ($bisneses as $bisnes => $value) {?>
            <form  method="post" action="config.php">
              <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;padding-left:10px;border-top:2px solid white">

                <div style="width: 55%;height:70px;display:flex;justify-content:start;align-items:center;flex-wrap:wrap;padding-left:10px;margin-top:-10px">
                  <h3 style="width: 55%;margin-top:10px;color:linen;margin-bottom:0px"><?=$bisneses[$bisnes]['name']?></h3>
                  <h5 style="width: 55%;color:linen;"><?=$bisneses[$bisnes]['categoria']?></h5>
                  <input type="hidden" name="bisnes_id" display='block' value = <?=$bisneses[$bisnes]['id']?>>
                  <input type="hidden" name="user_id" value="<?= $_SESSION['user'][0]['id']?>">
                </div>
                <div class="ui example11" style="margin-bottom:-15px;padding-left:0px; height:40px; position:static;margin-top:80px"!important>
                <!-- <div class="ui example11" style="margin-bottom:5px"> -->
                  <input type="text" name="addDate" placeholder="Date" style="width: 200px;margin-top:-80px;color:black" autoComplete="off" >
                  <button style="">Add</button>
                  
                  <div class="ui input"></div>
                  
                </div>
              </div>
            </form>
          <?php }?>
        </div>
      </div>

      <div class="calendar" id="calendar-app" style="width: 850px;background:#04b6e2">
        <div class="calendar--day-view" id="day-view">
          <span class="day-view-exit" id="day-view-exit">&times;</span>
          <span class="day-view-date" id="day-view-date">MAY 29 2016</span>
          <div class="day-view-content">
            <!-- <div class="day-highlight">
              You <span class="day-events" id="day-events">had no events for today</span>. &nbsp; <span tabindex="0" onkeyup="if(event.keyCode != 13) return; this.click();" class="day-events-link" id="add-event" data-date>Add a new event?</span>
            </div> -->
            <!-- <div class="day-add-event" id="add-day-event-box" data-active="false">
              <div class="row">
                <div class="half">
                  <label class="add-event-label">
                    Name of event
                    <input type="text" class="add-event-edit add-event-edit--long" placeholder="New event" id="input-add-event-name">
                  
                  </label>
                </div>
                <div class="qtr">
                  <label class="add-event-label">
                Start Time
                    <input type="text" class="add-event-edit" placeholder="8:15" id="input-add-event-start-time" data-options="1,2,3,4,5,6,7,8,9,10,11,12" data-format="datetime">
                    <input type="text" class="add-event-edit" placeholder="am" id="input-add-event-start-ampm" data-options="a,p,am,pm">
                  </label>
                </div>
                <div class="qtr">
                  <label class="add-event-label">
                End Time
                    <input type="text" class="add-event-edit" placeholder="9" id="input-add-event-end-time" data-options="1,2,3,4,5,6,7,8,9,10,11,12" data-format="datetime">
                    <input type="text" class="add-event-edit" placeholder="am" id="input-add-event-end-ampm" data-options="a,p,am,pm">
                  </label>
                </div>
                <div class="half">
                  <a onkeyup="if(event.keyCode != 13) return; this.click();" tabindex="0" id="add-event-save" class="event-btn--save event-btn">save</a>
                  <a tabindex="0" id="add-event-cancel" class="event-btn--cancel event-btn">cancel</a>
                </div>
              </div>
              
            </div> -->
            <div id="day-events-list" class="day-events-list">
              
            </div>
            <div class="day-inspiration-quote" id="inspirational-quote">
              
            </div>
          </div>
        </div>
        <div class="calendar--view" id="calendar-view">
          <div class="cview__month">
            <span class="cview__month-last" id="calendar-month-last">Apr</span>
            <span class="cview__month-current" id="calendar-month">May</span>
            <span class="cview__month-next" id="calendar-month-next">Jun</span>
          </div>
          <div class="cview__header">Sun</div>
          <div class="cview__header">Mon</div>
          <div class="cview__header">Tue</div>
          <div class="cview__header">Wed</div>
          <div class="cview__header">Thu</div>
          <div class="cview__header">Fri</div>
          <div class="cview__header">Sat</div>
          <div class="calendar--view" id="dates">
          </div>
        </div>
        <div class="footer">
          <!-- <span><span id="footer-date" class="footer__link">Today is May 30</span></span>     -->
          <span><span id="footer-date" class="footer__link"></span></span>    
        </div>
      </div>
     
            
    </div>
      
  </body>
</html>

<script>
  var today = new Date();
  $('.example11').calendar({
    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
    maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 7)
  });
</script>
 


<script>
  function CalendarApp(date) {
  
  if (!(date instanceof Date)) {
    date = new Date();
  }
  
  this.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  this.months = ['January', 'February', 'March', 'April', 'May', 'June', 'Jule', 'August', 'September', 'October', 'November', 'December'];
  this.quotes = ['Whatever the mind of man can conceive and believe, it can achieve. –Napoleon Hill', 'Strive not to be a success, but rather to be of value. –Albert Einstein', 'Two roads diverged in a wood, and I—I took the one less traveled by, And that has made all the difference.  –Robert Frost', 'I attribute my success to this: I never gave or took any excuse. –Florence Nightingale', 'You miss 100% of the shots you don’t take. –Wayne Gretzky', 'The most difficult thing is the decision to act, the rest is merely tenacity. –Amelia Earhart', 'Every strike brings me closer to the next home run. –Babe Ruth', 'Definiteness of purpose is the starting point of all achievement. –W. Clement Stone', 'Life isn’t about getting and having, it’s about giving and being. –Kevin Kruse', 'Life is what happens to you while you’re busy making other plans. –John Lennon', 'We become what we think about. –Earl Nightingale', 'Life is 10% what happens to me and 90% of how I react to it. –Charles Swindoll', 'The most common way people give up their power is by thinking they don’t have any. –Alice Walker', 'The mind is everything. What you think you become.  –Buddha', 'Winning isn’t everything, but wanting to win is. –Vince Lombardi', 'Every child is an artist.  The problem is how to remain an artist once he grows up. –Pablo Picasso', ' You can never cross the ocean until you have the courage to lose sight of the shore. –Christopher Columbus', 'I’ve learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel. –Maya Angelou', 'Either you run the day, or the day runs you. –Jim Rohn', 'Whether you think you can or you think you can’t, you’re right. –Henry Ford', 'The two most important days in your life are the day you are born and the day you find out why. –Mark Twain', 'Whatever you can do, or dream you can, begin it.  Boldness has genius, power and magic in it. –Johann Wolfgang von Goethe', 'The best revenge is massive success. –Frank Sinatra', 'People often say that motivation doesn’t last. Well, neither does bathing.  That’s why we recommend it daily. –Zig Ziglar', 'Life shrinks or expands in proportion to one’s courage. –Anais Nin', 'If you hear a voice within you say “you cannot paint,” then by all means paint and that voice will be silenced. –Vincent Van Gogh', 'There is only one way to avoid criticism: do nothing, say nothing, and be nothing. –Aristotle', 'Ask and it will be given to you; search, and you will find; knock and the door will be opened for you. –Jesus', 'The only person you are destined to become is the person you decide to be. –Ralph Waldo Emerson', 'Go confidently in the direction of your dreams.  Live the life you have imagined. –Henry David Thoreau',  'Few things can help an individual more than to place responsibility on him, and to let him know that you trust him.  –Booker T. Washington'];
  this.apts = [
    {
      name: 'Finish this web app',
      endTime: new Date(2016, 4, 30, 23),
      startTime: new Date(2016, 4, 30, 21),
      day: new Date(2016, 4, 30).toString()
    },
     {
      name: 'My Birthday!',
      endTime: new Date(2016, 4, 1, 23, 59),
      startTime: new Date(2016, 4, 1, 0),
      day: new Date(2016, 4, 1).toString()
    },
    
  ];
  
  this.aptDates = [new Date(2016, 4, 30).toString(),new Date(2016, 4, 1).toString()];
  this.eles = {
  };
  this.calDaySelected = null;
  
  this.calendar = document.getElementById("calendar-app");
  
  this.calendarView = document.getElementById("dates");
  
  this.calendarMonthDiv = document.getElementById("calendar-month");
  this.calendarMonthLastDiv = document.getElementById("calendar-month-last");
  this.calendarMonthNextDiv = document.getElementById("calendar-month-next");
  
  this.dayInspirationalQuote = document.getElementById("inspirational-quote");
   
  this.todayIsSpan = document.getElementById("footer-date");
  // this.eventsCountSpan = document.getElementById("footer-events");
  this.dayViewEle = document.getElementById("day-view");
  this.dayViewExitEle = document.getElementById("day-view-exit");
  this.dayViewDateEle = document.getElementById("day-view-date");
  this.addDayEventEle = document.getElementById("add-event");
  this.dayEventsEle = document.getElementById("day-events");
  
  this.dayEventAddForm = {
    cancelBtn: document.getElementById("add-event-cancel"),
    addBtn: document.getElementById("add-event-save"),
    nameEvent:  document.getElementById("input-add-event-name"),
    startTime:  document.getElementById("input-add-event-start-time"),
    endTime:  document.getElementById("input-add-event-end-time"),
    startAMPM:  document.getElementById("input-add-event-start-ampm"),
    endAMPM:  document.getElementById("input-add-event-end-ampm")
  };
  this.dayEventsList = document.getElementById("day-events-list");
  this.dayEventBoxEle = document.getElementById("add-day-event-box");
  
  /* Start the app */
  this.showView(date);
  this.addEventListeners();
  this.todayIsSpan.textContent = "Today is " + this.months[date.getMonth()] + " " + date.getDate();  
}

CalendarApp.prototype.addEventListeners = function(){
  
  this.calendar.addEventListener("click", this.mainCalendarClickClose.bind(this));
  this.todayIsSpan.addEventListener("click", this.showView.bind(this));
  this.calendarMonthLastDiv.addEventListener("click", this.showNewMonth.bind(this));
  this.calendarMonthNextDiv.addEventListener("click", this.showNewMonth.bind(this));
  this.dayViewExitEle.addEventListener("click", this.closeDayWindow.bind(this));
  this.dayViewDateEle.addEventListener("click", this.showNewMonth.bind(this));
  this.addDayEventEle.addEventListener("click", this.addNewEventBox.bind(this));
  this.dayEventAddForm.cancelBtn.addEventListener("click", this.closeNewEventBox.bind(this));
  this.dayEventAddForm.cancelBtn.addEventListener("keyup", this.closeNewEventBox.bind(this));
  
  this.dayEventAddForm.startTime.addEventListener("keyup",this.inputChangeLimiter.bind(this));
  this.dayEventAddForm.startAMPM.addEventListener("keyup",this.inputChangeLimiter.bind(this));
  this.dayEventAddForm.endTime.addEventListener("keyup",this.inputChangeLimiter.bind(this));
  this.dayEventAddForm.endAMPM.addEventListener("keyup",this.inputChangeLimiter.bind(this));
  this.dayEventAddForm.addBtn.addEventListener("click",this.saveAddNewEvent.bind(this));

};
CalendarApp.prototype.showView = function(date){
  if ( !date || (!(date instanceof Date)) ) date = new Date();
  var now = new Date(date),
      y = now.getFullYear(),
      m = now.getMonth();
  var today = new Date();
  
  var lastDayOfM = new Date(y, m + 1, 0).getDate();
  var startingD = new Date(y, m, 1).getDay();
  var lastM = new Date(y, now.getMonth()-1, 1);
  var nextM = new Date(y, now.getMonth()+1, 1);
 
  this.calendarMonthDiv.classList.remove("cview__month-activate");
  this.calendarMonthDiv.classList.add("cview__month-reset");
  
  while(this.calendarView.firstChild) {
    this.calendarView.removeChild(this.calendarView.firstChild);
  }
  
  // build up spacers
  for ( var x = 0; x < startingD; x++ ) {
    var spacer = document.createElement("div");
    spacer.className = "cview--spacer";
    this.calendarView.appendChild(spacer);
  }
  
  for ( var z = 1; z <= lastDayOfM; z++ ) {
   
    var _date = new Date(y, m ,z);
    var day = document.createElement("div");
    day.className = "cview--date";
    day.textContent = z;
    day.setAttribute("data-date", _date);
    day.onclick = this.showDay.bind(this);
    
    // check if todays date
    if ( z == today.getDate() && y == today.getFullYear() && m == today.getMonth() ) {
      day.classList.add("today");
      
    }
    
     // check if has events to show
    if ( this.aptDates.indexOf(_date.toString()) !== -1 ) {
      day.classList.add("has-events");
    }
    
    this.calendarView.appendChild(day);
  }
  
  var _that = this;
  setTimeout(function(){
    _that.calendarMonthDiv.classList.add("cview__month-activate");
  }, 50);
  
  this.calendarMonthDiv.textContent = this.months[now.getMonth()] + " " + now.getFullYear();
  this.calendarMonthDiv.setAttribute("data-date", now);

  
  this.calendarMonthLastDiv.textContent = "← " + this.months[lastM.getMonth()];
  this.calendarMonthLastDiv.setAttribute("data-date", lastM);
  
  this.calendarMonthNextDiv.textContent = this.months[nextM.getMonth()] + " →";
  this.calendarMonthNextDiv.setAttribute("data-date", nextM);
  
}
CalendarApp.prototype.showDay = function(e, dayEle) {
  e.stopPropagation();
  if ( !dayEle ) {
    dayEle = e.currentTarget;
  }
  var dayDate = new Date(dayEle.getAttribute('data-date'));
  
  this.calDaySelected = dayEle;
  
  this.openDayWindow(dayDate);
  

  
};
CalendarApp.prototype.openDayWindow = function(date){
  
  var now = new Date();
  var day = new Date(date);
  // this.dayViewDateEle.textContent = this.days[day.getDay()] + ", " + this.months[day.getMonth()] + " " + day.getDate() + ", " + day.getFullYear();
  this.dayViewDateEle.textContent = this.months[day.getMonth()] + " " + day.getDate() + ", " + day.getFullYear();
  this.dayViewDateEle.setAttribute('data-date', day);
  this.dayViewEle.classList.add("calendar--day-view-active");
  // document.getElementById('day-view').createElements(input)
  // $('#day-view').find(':h1').innerHTML = '';
  $('#day-view').find('h1').remove();
  const or = this.dayViewDateEle.textContent
  console.log(or)

  


  var array = $.ajax({
    url: "ajax.php",
    data: {'or': or},
    type: "post", 
    success: function (response) {
      let div = document.getElementById('inspirational-quote')
      // div.style.background='blue'
      let mydiv = document.createElement('div')
      let paymanavorvacutyun = JSON.parse(response)[0]
      let biznesner = JSON.parse(response)[1]
      console.log(JSON.parse(response));
      mydiv.style.width = '80%'
      mydiv.style.display = 'flex'
      mydiv.style.flexWrap = 'wrap'
      // mydiv.style.background = 'yellow'
      mydiv.style.justifyContent = 'start'
      paymanavorvacutyun.forEach(el => {
        
        
        biznesner.forEach(elem => {
          if(elem.id == el.bisnes_id){
            bisnes = elem.name
          }
        })

        let time = el.time

        let h1 = document.createElement('h1')
        h1.innerHTML = 'You will must at the ' + bisnes + ' office at ' + time 
        h1.style.color = 'black'
        h1.style.marginTop = '15px'
        h1.style.paddingLeft = '20px'
        mydiv.append(h1)
        console.log(el)
        div.append(mydiv)
        
        
      });
    },
    error: function (request, status, error) {
        alert('alert');
    }
  })
  











  
 

  

  /* Contextual lang changes based on tense. Also show btn for scheduling future events */
  var _dayTopbarText = '';
  if ( day < new Date(now.getFullYear(), now.getMonth(), now.getDate())) {
    _dayTopbarText = "had ";
    this.addDayEventEle.style.display = "none";
  } else {
     _dayTopbarText = "have ";
     this.addDayEventEle.style.display = "inline";
  }
  this.addDayEventEle.setAttribute("data-date", day);
  
  var eventsToday = this.showEventsByDay(day);
  if ( !eventsToday ) {
    _dayTopbarText += "no ";
    var _rand = Math.round(Math.random() * ((this.quotes.length - 1 ) - 0) + 0);
    this.dayInspirationalQuote.textContent = this.quotes[_rand];
  } else {
    _dayTopbarText += eventsToday.length + " ";
    this.dayInspirationalQuote.textContent = null;
  }
  //this.dayEventsList.innerHTML = this.showEventsCreateHTMLView(eventsToday);
  while(this.dayEventsList.firstChild) {
    this.dayEventsList.removeChild(this.dayEventsList.firstChild);
  }
  
  this.dayEventsList.appendChild(this.showEventsCreateElesView(eventsToday));
  
  
  this.dayEventsEle.textContent = _dayTopbarText + "events on " + this.months[day.getMonth()] + " " + day.getDate() + ", " + day.getFullYear();
  
  
};

// CalendarApp.prototype.showEventsCreateElesView = function(events) {
//   var ul = document.createElement("ul");
//   ul.className = 'day-event-list-ul';
//   events = this.sortEventsByTime(events);
//   var _this = this;
//   events.forEach(function(event){
//     var _start = new Date(event.startTime);
//     var _end = new Date(event.endTime);
//     var idx = event.index;
//     var li = document.createElement("li");
//     li.className = "event-dates";
//     // li.innerHtml
//     var html = "<span class='start-time'>" + _start.toLocaleTimeString(navigator.language,{hour: '2-digit', minute:'2-digit'}) + "</span> <small>through</small> ";
//     html += "<span class='end-time'>" + _end.toLocaleTimeString(navigator.language,{hour: '2-digit', minute:'2-digit'}) + ( (_end.getDate() != _start.getDate()) ? ' <small>on ' + _end.toLocaleDateString() + "</small>" : '') +"</span>";
    

//     html += "<span class='event-name'>" + event.name + "</span>";
    
//     var div = document.createElement("div");
//     div.className = "event-dates";
//     div.innerHTML = html;
    
//     var deleteBtn = document.createElement("span");
//     var deleteText = document.createTextNode("delete");
//     deleteBtn.className = "event-delete";
//     deleteBtn.setAttribute("data-idx", idx);
//     deleteBtn.appendChild(deleteText);
//     deleteBtn.onclick = _this.deleteEvent.bind(_this);
    
//     div.appendChild(deleteBtn);
    
//     li.appendChild(div);
//     ul.appendChild(li);
//   });
//   return ul;
// };
// CalendarApp.prototype.deleteEvent = function(e) {
//   var deleted = this.apts.splice(e.currentTarget.getAttribute("data-idx"),1);
//   var deletedDate = new Date(deleted[0].day);
//   var anyDatesLeft = this.showEventsByDay(deletedDate);
//   if ( anyDatesLeft === false ) {
//     // safe to remove from array
//     var idx = this.aptDates.indexOf(deletedDate.toString());
//     if (idx >= 0) {
//        this.aptDates.splice(idx,1);
//       // remove dot from calendar view
//       var ele = document.querySelector('.cview--date[data-date="'+ deletedDate.toString() +'"]');
//       if ( ele ) {
//         ele.classList.remove("has-events");
//       }
//     }
//   }
//   this.openDayWindow(deletedDate);;
// };
// CalendarApp.prototype.sortEventsByTime = function(events) {
//   if (!events) return [];
//   return events.sort(function compare(a, b) {
//     if (new Date(a.startTime) < new Date(b.startTime)) {
//       return -1;
//     }
//     if (new Date(a.startTime) > new Date(b.startTime)) {
//       return 1;
//     }
//     // a must be equal to b
//     return 0;
//   });
// };
// CalendarApp.prototype.showEventsByDay = function(day) {
//   var _events = [];
//   this.apts.forEach(function(apt, idx){
//     if ( day.toString() == apt.day.toString() ) {
//       apt.index = idx;
//       _events.push(apt);
//     }
//   });
//   return (_events.length) ? _events : false;
// };
CalendarApp.prototype.closeDayWindow = function(){
  this.dayViewEle.classList.remove("calendar--day-view-active");
  this.closeNewEventBox();
};
CalendarApp.prototype.mainCalendarClickClose = function(e){
  if ( e.currentTarget != e.target ) {
    return;
  }
  
  this.dayViewEle.classList.remove("calendar--day-view-active");
  this.closeNewEventBox();
};
CalendarApp.prototype.addNewEventBox = function(e){
  var target = e.currentTarget;
  this.dayEventBoxEle.setAttribute("data-active", "true"); 
  this.dayEventBoxEle.setAttribute("data-date", target.getAttribute("data-date"));
  
};
CalendarApp.prototype.closeNewEventBox = function(e){
  
  if (e && e.keyCode && e.keyCode != 13) return false;
  
  this.dayEventBoxEle.setAttribute("data-active", "false");
  // reset values
  this.resetAddEventBox();
  
};
CalendarApp.prototype.saveAddNewEvent = function() {
  var saveErrors = this.validateAddEventInput();
  if ( !saveErrors ) {
    this.addEvent();
  }
};

// CalendarApp.prototype.addEvent = function() {
  
//   var name = this.dayEventAddForm.nameEvent.value.trim();
//   var dayOfDate = this.dayEventBoxEle.getAttribute("data-date");
//   var dateObjectDay =  new Date(dayOfDate);
//   var cleanDates = this.cleanEventTimeStampDates();
  
//   this.apts.push({
//     name: name,
//     day: dateObjectDay,
//     startTime: cleanDates[0],
//     endTime: cleanDates[1]
//   });
//   this.closeNewEventBox();
//   this.openDayWindow(dayOfDate);
//   this.calDaySelected.classList.add("has-events");
//   // add to dates
//   if ( this.aptDates.indexOf(dateObjectDay.toString()) === -1 ) {
//     this.aptDates.push(dateObjectDay.toString());
//   }
  
// };
// CalendarApp.prototype.convertTo23HourTime = function(stringOfTime, AMPM) {
//   // convert to 0 - 23 hour time
//   var mins = stringOfTime.split(":");
//   var hours = stringOfTime.trim();
//   if ( mins[1] && mins[1].trim() ) {
//     hours = parseInt(mins[0].trim());
//     mins = parseInt(mins[1].trim());
//   } else {
//     hours = parseInt(hours);
//     mins = 0;
//   }
//   hours = ( AMPM == 'am' ) ? ( (hours == 12) ? 0 : hours ) : (hours <= 11) ? parseInt(hours) + 12 : hours;
//   return [hours, mins];
// };
// CalendarApp.prototype.cleanEventTimeStampDates = function() {
  
//   var startTime = this.dayEventAddForm.startTime.value.trim() || this.dayEventAddForm.startTime.getAttribute("placeholder") || '8';
//   var startAMPM = this.dayEventAddForm.startAMPM.value.trim() || this.dayEventAddForm.startAMPM.getAttribute("placeholder") || 'am';
//   startAMPM = (startAMPM == 'a') ? startAMPM + 'm' : startAMPM;
//   var endTime = this.dayEventAddForm.endTime.value.trim() || this.dayEventAddForm.endTime.getAttribute("placeholder") || '9';
//   var endAMPM = this.dayEventAddForm.endAMPM.value.trim() || this.dayEventAddForm.endAMPM.getAttribute("placeholder") || 'pm';
//   endAMPM = (endAMPM == 'p') ? endAMPM + 'm' : endAMPM;
//   var date = this.dayEventBoxEle.getAttribute("data-date");
  
//   var startingTimeStamps = this.convertTo23HourTime(startTime, startAMPM);
//   var endingTimeStamps = this.convertTo23HourTime(endTime, endAMPM);
  
//   var dateOfEvent = new Date(date);
//   var startDate = new Date(dateOfEvent.getFullYear(), dateOfEvent.getMonth(), dateOfEvent.getDate(), startingTimeStamps[0], startingTimeStamps[1]);
//   var endDate = new Date(dateOfEvent.getFullYear(), dateOfEvent.getMonth(), dateOfEvent.getDate(), endingTimeStamps[0], endingTimeStamps[1]);
  
//   // if end date is less than start date - set end date back another day
//   if ( startDate > endDate ) endDate.setDate(endDate.getDate() + 1);
  
//   return [startDate, endDate];
  
// };
// CalendarApp.prototype.validateAddEventInput = function() {

//   var _errors = false;
//   var name = this.dayEventAddForm.nameEvent.value.trim();
//   var startTime = this.dayEventAddForm.startTime.value.trim();
//   var startAMPM = this.dayEventAddForm.startAMPM.value.trim();
//   var endTime = this.dayEventAddForm.endTime.value.trim();
//   var endAMPM = this.dayEventAddForm.endAMPM.value.trim();
  
//   if (!name || name == null) {
//     _errors = true;
//     this.dayEventAddForm.nameEvent.classList.add("add-event-edit--error");
//     this.dayEventAddForm.nameEvent.focus();
//   } else {
//      this.dayEventAddForm.nameEvent.classList.remove("add-event-edit--error");
//   }
  
// //   if (!startTime || startTime == null) {
// //     _errors = true;
// //     this.dayEventAddForm.startTime.classList.add("add-event-edit--error");
// //   } else {
// //      this.dayEventAddForm.startTime.classList.remove("add-event-edit--error");
// //   }
  
//   return _errors;
  
  
// };
var timeOut = null;
var activeEle = null;
CalendarApp.prototype.inputChangeLimiter = function(ele) {
  
  if ( ele.currentTarget ) {
    ele = ele.currentTarget;
  }
  if (timeOut && ele == activeEle){
    clearTimeout(timeOut);
  }
  
  var limiter = CalendarApp.prototype.textOptionLimiter;

  var _options = ele.getAttribute("data-options").split(",");
  var _format = ele.getAttribute("data-format") || 'text';
  timeOut = setTimeout(function(){
    ele.value = limiter(_options, ele.value, _format);
  }, 600);
  activeEle = ele;
  
};
// CalendarApp.prototype.textOptionLimiter = function(options, input, format){
//   if ( !input ) return '';
  
//   if ( input.indexOf(":") !== -1 && format == 'datetime' ) {
 
//     var _splitTime = input.split(':', 2);
//     if (_splitTime.length == 2 && !_splitTime[1].trim()) return input;
//     var _trailingTime = parseInt(_splitTime[1]);
//     /* Probably could be coded better -- a block to clean up trailing data */
//     if (options.indexOf(_splitTime[0]) === -1) {
//       return options[0];
//     }
//     else if (_splitTime[1] == "0" ) {
//       return input;
//     }
//     else if (_splitTime[1] == "00" ) {
//       return _splitTime[0] +  ":00";
//     }
//     else if (_trailingTime < 10 ) {
//       return _splitTime[0] + ":" + "0" + _trailingTime;
//     }
//     else if ( !Number.isInteger(_trailingTime) || _trailingTime < 0 || _trailingTime > 59 )  {
//       return _splitTime[0];
//     } 
//     return _splitTime[0] + ":" + _trailingTime;
//   }
//   if ((input.toString().length >= 3) ) {
//     var pad = (input.toString().length - 4) * -1;
//     var _hour, _min;
//     if (pad == 1) {
//       _hour = input[0];
//       _min = input[1] + input[2];
//     } else {
//       _hour = input[0] + input[1];
//       _min = input[2] + input[3];
//     }
    
//     _hour = Math.max(1,Math.min(12,(_hour)));
//     _min = Math.min(59,(_min));
//     if ( _min < 10 ) { 
//       _min = "0" + _min;
//     }
//     _min = (isNaN(_min)) ? '00' : _min;
//     _hour = (isNaN(_hour)) ? '9' : _hour ;

//     return _hour + ":" + _min;
    
//   }

//   if (options.indexOf(input) === -1) {
//     return options[0];
//   }
  
//   return input;
// };
// CalendarApp.prototype.resetAddEventBox = function(){
//   this.dayEventAddForm.nameEvent.value = '';
//   this.dayEventAddForm.nameEvent.classList.remove("add-event-edit--error");
//   this.dayEventAddForm.endTime.value = '';
//   this.dayEventAddForm.startTime.value = '';
//   this.dayEventAddForm.endAMPM.value = '';
//   this.dayEventAddForm.startAMPM.value = '';
// };
CalendarApp.prototype.showNewMonth = function(e){
  var date = e.currentTarget.dataset.date;
  var newMonthDate = new Date(date);
  this.showView(newMonthDate);
  this.closeDayWindow();
  return true;
};

var calendar = new CalendarApp();
console.log(calendar);


</script>





      

