<?php
class MenuView implements View
{
  function render()
  { 
    $user = Session::getLoggedInUser(); ?>
    <!-- Menu code here, someday -->
    <div class="menu-bar">
      <div class="menu-bar-content">
        <div onclick="window.location.href = '/?p=dataentry';" class="menu-bar-logo"></div>
        <div class="menu-bar-icon"></div>
		<div class="menu-dropdown">
			<!-- Menu stuff here -->
			<div id = "links">
				<ul>
					<li><a href = "https://www.google.com/" target="_blank">Front page</a></li>
					<li><a href = "https://www.google.com/" target="_blank">Second page</a></li>
					<li><a href = "https://www.google.com/" target="_blank">Last page</a></li>
					<li><a href = "https://www.google.com/" target="_blank">Resource page</a></li>
				</ul>
			</div>
		</div>
      </div>
    </div>
  <?php }
} 

