<?php include('header.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/difficulty.css">
    <script src="js/game.js"></script>
    
    <script>

        // function that takes users to menu page
        function goHome() {
            window.location = 'index.php'
        }

        // function that takes users to game page
        function goPlay() {
            window.location = 'game.php'
        }


     </script>

		<?php include('menu_button.php'); ?>

        <div id="text"><label for="level">Difficulty:</label> </div>
               
	    <div class="lvimg">
        		<img id="lvImg" src="resources/level/Lv1(fake).png" alt="Level Image" height="280" width="280">
		</div>
        <div class="levelselection">
            	<input type="range" id="level" name="level" value="1" min="1" max="10" onchange="updateImg(this.value)">
    	</div>

        <!--<button type="button" onclick="goPlay()">Play</button>-->
		<div class='play'>
		    <input type='button' class='playBtn' value='Play' onclick="$('#play').click()">
		    <!-- just a placeholder (invisible) for jquery mobile transitions -->
		    <a id='play' href='game.php' data-transition='flow'></a>
		</div>


<?php include('footer.php'); ?>
