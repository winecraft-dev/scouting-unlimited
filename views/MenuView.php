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
      </div>
    </div>
  <?php }
} 

