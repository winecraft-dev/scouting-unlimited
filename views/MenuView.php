<?php
class MenuView implements View
{
  function render()
  { 
    $user = Session::getLoggedInUser(); ?>
    <!-- Menu code here, someday -->
    <div class="menu-bar">
      <div class="menu-bar-content">
        <div class="menu-bar-logo"></div>
      </div>
    </div>
  <?php }
} 

