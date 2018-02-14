<?php
class MenuView implements View
{
  function render()
  { 
    $user = Session::getLoggedInUser(); ?>
    <!-- Menu code here, someday -->
    <div class="menu-bar">
      <div class="menu-bar-content">
        <a href="/?p=dataentrypanel" style="width: 70px;"><div class="menu-bar-logo"></div></a>
        <div class="menu-bar-icon"></div>
		    <div class="menu-dropdown">
			    <div class="menu-dropdown-content">
	          <a href="/?p=schedule"><div class="menu-icon icon-exit"></div>Schedule</a>
	          <?php if($user->administrator == 1) { ?>
	            <a href="/?p=adminpanel"><div class="menu-icon icon-exit"></div>Admin Panel</a>
	          <?php } ?>
	          <a href="/?c=login&do=logout"><div class="menu-icon icon-exit"></div>Log Out</a>
	        </div>
		    </div>
      </div>
    </div>
  <?php }
} 

