<?php
class AdminPanelView implements View 
{
  public function render()
  { 
    $users = (new UserDatabaseModel())->getUsers(); ?>
    <div class="page-section">
      <div class="page-section-head">Scout Management</div>
      <table class="adminpanel-table">
        <colgroup>
          <col span="1" style="width: 50%;">
          <col span="1" style="width: 25%;">
          <col span="1" style="width: 25%;">
        </colgroup>
        <tr>
          <th>Name</th>
          <th>User Type</th>
          <th>Scout Position</th>
        </tr>
        <?php foreach($users as $user) { ?>
          <tr>
            <td><?= $user->name ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->name ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <div class="page-section">
      <div class="page-section-head">Scout Management</div>
      
    </div>
  <?php }
}
?>

