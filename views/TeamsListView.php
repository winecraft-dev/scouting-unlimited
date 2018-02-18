<?php

class TeamsListView implements View
{
  public function render()
  { 
	$teams = (new TeamsDatabaseModel())->getTeams(); ?>
    <div class="page-section">
      <div class="page-section-head"> Rankings </div>
      <div class="page-section-content">
        <!-- Put your rankings table code here -->
		
		<table class="teamlist" id="teamtable">
		<colgroup>
            <col span="1" style="width: 25%; height: 35px;">
            <col span="1" style="width: 25%; height: 35px;">
            <col span="1" style="width: 25%; height: 35px;">
            <col span="1" style="width: 25%; height: 35px;">
          </colgroup>
		<tr class="teamlist">
			<th onclick="sortTableInt(0)">Team Number</th>
			<th onclick="sortTableString(1)">Team Name</th>
			<th onclick="sortTableInt(2)">Place Holder</th>
			<th onclick="sortTableInt(3)">Place Holder</th>
		</tr>
		
		<?php 
		$i=0; 
		foreach($teams as $team) {
		if($i % 2 == 0) { ?>
		
			<tr class="teamlist-color1">
				<td class="teamlist"><?= $team->number ?></td>
				<td class="teamlist"><?= $team->name ?></td>
				<td class="teamlist"></td>
				<td class="teamlist"></td>
            
			<?php } else { ?>
			<tr class="teamlist-color2">
				<td class="teamlist"><?= $team->number ?></td>
				<td class="teamlist"><?= $team->name ?></td>
				<td class="teamlist"></td>
				<td class="teamlist"></td>
            <?php } ?>
		</tr>
		
		<?php $i++; } ?>
		</table>
      </div>
    </div>
  <?php }
}
?>
