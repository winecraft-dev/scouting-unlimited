<?php
class MatchDataView implements View
{
  public function render()
  { 
    $dataDefinitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions(); ?>
    <div class="page-section">
      <div class="page-section-head">Match Number</div>
      <div class="page-section-content">
        <table class="schedule">
          <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 15.833333333%;">
            <col span="1" style="width: 15.833333333%;">
            <col span="1" style="width: 15.833333333%;">
            <col span="1" style="width: 15.833333333%;">
            <col span="1" style="width: 15.833333333%;">
            <col span="1" style="width: 15.833333333%;">
          </colgroup>
          <tr>
					  <th class="schedule-corner schedule-mid">Name</th>
					  <th class="schedule-red schedule-mid"><a style="color: black;" href="#" id="red1">Red 1</a></th>
					  <th class="schedule-red schedule-mid"><a style="color: black;" href="#" id="red2">Red 2</a></th>
					  <th class="schedule-red schedule-mid"><a style="color: black;" href="#" id="red3">Red 3</a></th>
					  <th class="schedule-blue schedule-mid"><a style="color: black;" href="#" id="blue1">Blue 1</a></th>
					  <th class="schedule-blue schedule-mid"><a style="color: black;" href="#" id="blue2">Blue 2</a></th>
					  <th class="schedule-blue"><a style="color: black;" href="#" id="blue3">Blue 3</a></th>
				  </tr>
				  <tr class="schedule-zebra-dark">
				    <?php $id = "dead"; ?>
            <td id=<?= $id ?> class="schedule-mid schedule-match-number">Dead</td>
            <td class="schedule-mid" id=<?= 'red1_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'red2_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'red3_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'blue1_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'blue2_' . $id ?>></td>
            <td id=<?= 'blue3_' . $id ?>></td>
          </tr>
          <tr class="schedule-zebra-light">
				    <?php $id = "dead_shortly"; ?>
            <td id=<?= $id ?> class="schedule-mid schedule-match-number">Dead for part of match</td>
            <td class="schedule-mid" id=<?= 'red1_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'red2_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'red3_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'blue1_' . $id ?>></td>
            <td class="schedule-mid" id=<?= 'blue2_' . $id ?>></td>
            <td id=<?= 'blue3_' . $id ?>></td>
          </tr>
          <?php $i = 0;
          foreach($dataDefinitions as $definition) { 
            $id = str_replace(" ", "-", $definition['title']);?>
            <?php if($i % 2 == 0) { ?>
              <tr class="schedule-zebra-dark">
                <td id=<?= $id ?> class="schedule-mid schedule-match-number"><?= $definition['title'] ?></td>
                <td class="schedule-mid" id=<?= 'red1_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'red2_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'red3_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'blue1_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'blue2_' . $id ?>></td>
                <td id=<?= 'blue3_' . $id ?>></td>
              </tr>
            <?php } else { ?>
              <tr class="schedule-zebra-light">
                <td id=<?= $id ?> class="schedule-mid schedule-match-number"><?= $definition['title'] ?></td>
                <td class="schedule-mid" id=<?= 'red1_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'red2_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'red3_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'blue1_' . $id ?>></td>
                <td class="schedule-mid" id=<?= 'blue2_' . $id ?>></td>
                <td id=<?= 'blue3_' . $id ?>></td>
              </tr>
            <?php } ?>
          <?php $i ++;
          } ?>
        </table>
      </div>
    </div>
  <?php }
}
