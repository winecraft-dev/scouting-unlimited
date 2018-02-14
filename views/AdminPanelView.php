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
          <th>Delete</th>
        </tr>
        <?php foreach($users as $user) { ?>
          <tr class="adminpanel-user" id=<?= $user->id ?>>
            <td><?= $user->name ?></td>
            <td><select class="adminpanel-select adminpanel-administrator" id=<?= $user->id ?>>
              <option value="-1" <?= $user->administrator == -1 ? "selected" : "" ?>>Unapproved</option>
              <option value="0" <?= $user->administrator == 0 ? "selected" : "" ?>>Scout</option>
              <option value="1" <?= $user->administrator == 1 ? "selected" : "" ?>>Administrator</option>
            </select></td>
            <td>
              <select class="adminpanel-scouting-position" id=<?= $user->id ?>>
                <option value="0" <?= $user->scouting_position == 0 ? "selected" : "" ?>>Not Selected</option>
                <option value="1" <?= $user->scouting_position == 1 ? "selected" : "" ?>>Red 1</option>
                <option value="2" <?= $user->scouting_position == 2 ? "selected" : "" ?>>Red 2</option>
                <option value="3" <?= $user->scouting_position == 3 ? "selected" : "" ?>>Red 3</option>
                <option value="4" <?= $user->scouting_position == 4 ? "selected" : "" ?>>Blue 1</option>
                <option value="5" <?= $user->scouting_position == 5 ? "selected" : "" ?>>Blue 2</option>
                <option value="6" <?= $user->scouting_position == 6 ? "selected" : "" ?>>Blue 3</option>
              </select>
            </td>
            <?php if($user->administrator == -1) { ?>
              <td class="adminpanel-trash" id=<?= $user->id ?>></td>
            <?php } else { ?>
              <td class="adminpanel-keep" id=<?= $user->id ?>></td>
            <?php } ?>
          </tr>
        <?php } ?>
      </table>
    </div>
    <div class="page-section">
      <div class="page-section-head">Load New Event</div>
      
    </div>
  <?php }
}
?>

