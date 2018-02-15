<?php
class DataEntryFormView implements View
{  
  public function render()
  { $data_definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions(); ?>
    <div class="page-section">
      <div class="page-section-head">
        Data Entry
      </div>
      <div class="page-section-content">
        <div class="dataentry-form">
          <div class="dataentry-sections">
            <div id="prematch" class="dataentry-tab">Prematch</div>
            <div id="auton" class="dataentry-tab">Auton</div>
            <div id="teleop" class="dataentry-tab">Teleop</div>
            <div id="endgame" class="dataentry-tab">End Game</div>
          </div>
          <div id="prematch" class="dataentry-subform">
            <div class="dataentry-module">
              Match Number<br>
              <input id="match_number" type="number" class="dataentry-module-number"></input>
            </div>
            <div class="dataentry-module">
              Team Number<br>
              <input id="team_number" type="number" class="dataentry-module-number"></input>
            </div>
            <div class="dataentry-module">
              No Show<br>
              <input id="dead" type="checkbox" class="dataentry-module-boolean"></input>
            </div>
            <div class="dataentry-module">
              Lost Comms<br>
              <input id="dead_shortly" type="checkbox" class="dataentry-module-boolean"></input>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }
  
  public function getInputByDefinition($definition)
  {
    $id = $definition['title'];
    $type = '';
    $module = '';
    
    switch($definition['data_type'])
    {
      case 0:
        $type = 'checkbox';
        break;
      case 1:
        $type = 'num';
        break;
      case 2:
        $type = 'text';
        break;
    }
    
    switch($definition['module'])
    {
      case 0:
        $module = 'dataentry-module-number';
        break;
      case 1:
        $module = 'dataentry-module-number-iterating';
        break;
      case 2:
        $module = 'dataentry-module-boolean';
        break;
      case 3:
        $module = 'dataentry-module-text';
        break;
      case 4:
        $module = 'dataentry-module-dropdown';
        break;
    } ?>
    <input id=<?= $id ?> type=<?= $type ?> class=<?= $module ?>></input>
  <?php }
}
