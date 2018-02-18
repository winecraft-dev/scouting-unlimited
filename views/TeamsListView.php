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
			<th onclick="sortTable(0)">Team Number</th>
			<th onclick="sortTable(1)">Something</th>
			<th onclick="sortTable(2)">Something</th>
			<th onclick="sortTable(3)">Something</th>
		</tr>
		
		<?php 
		$i=0; 
		foreach($teams as $team) {
		if($i % 2 == 0) { ?>
		
			<tr class="teamlist-colorlight">
				<td class="teamlist"><?= $team->number ?></td>
				<td class="teamlist"></td>
				<td class="teamlist"></td>
				<td class="teamlist"></td>
            
			<?php } else { ?>
			<tr class="teamlist-colordark">
				<td class="teamlist"><?= $team->number ?></td>
				<td class="teamlist"></td>
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
