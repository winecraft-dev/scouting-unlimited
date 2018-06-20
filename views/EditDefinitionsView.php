<?php
class EditDefinitionsView implements View 
{
	public function render()
	{
		$dataDefinitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions();
		$averageDefinitions = (new DataDefinitionsDatabaseModel())->getAverageDefinitions();
		$pitNotesDefinitions = (new DataDefinitionsDatabaseModel())->getPitNotesDefinitions();
		?>
		<div class="page-section">
			<div class="page-section-head">Data Definitions</div>
			<div class="page-section-content">
				<table class="adminpanel-table">
					<colgroup>
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 15%;">
						<col span="1" style="width: 5%;">
					</colgroup>
					<tr>
						<th>Name</th>
						<th>Module</th>
						<th>Section</th>
						<th>Data Type</th>
						<th>Number</th>
						<th>Dropdown Values</th>
						<th>Delete</th>
					</tr>
					<?php foreach($dataDefinitions as $definition) { ?>
						<tr>
							<td><?= $definition['title']?></td>
							<td><?php switch($definition['module']) { 
								case 0:
									echo "Raw Number";
									break;
								case 1:
									echo "Iterating Number";
									break;
								case 2:
									echo "Checkbox";
									break;
								case 3:
									echo "Text Box";
									break;
								case 4:
									echo "Dropdown";
									break;
							} ?></td>
							<td><?php switch($definition['section']) {
								case 0:
									echo "Auto";
									break;
								case 1:
									echo "Teleop";
									break;
								case 2:
									echo "End Game";
									break;
							} ?></td>
							<td><?php switch($definition['data_type']) {
								case 0:
									echo "Boolean";
									break;
								case 1:
									echo "Number";
									break;
								case 2:
									echo "Text";
									break;
							} ?></td>
							<td><?= $definition['number']?></td>
							<td><?= $definition['dropdown_values']?></td>
							<td class="adminpanel-trash data-definition" id=<?= $definition['id'] ?>></td>
						</tr>
					<?php } ?>
				</table>
				<form method="POST" action="/?p=edit&do=addDataDefinition">
					Name: <br>
					<input placeholder="Name" type="text" name="name"></input><br>
					Module: <br>
					<select class="adminpanel-scouting-position" name="module">
						<option selected value="0">Raw Number</option>
						<option value="1">Iterating Number</option>
						<option value="2">Checkbox</option>
						<option value="3">Text Box</option>
						<option value="4">Dropdown</option>
					</select><br>
					Section: <br>
					<select class="adminpanel-scouting-position" name="section">
						<option selected value="0">Auto</option>
						<option value="1">Teleop</option>
						<option value="2">End Game</option>
					</select><br>
					Dropdown Values: <br>
					<input placeholder="Dropdown Values" type="text" name="dropdown_values"></input><br>
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	<?php }
}
?>