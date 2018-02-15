<?php
class DataEntryFormView implements View
{  
  public function render()
  { 
    $data_definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions(); ?>
    <div class="page-section">
      <div class="page-section-head">
        Data Form
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
          <div id="auton" class="dataentry-subform">
            Auton
          </div>
          <div id="teleop" class="dataentry-subform">
            teleop
          </div>
          <div id="endgame" class="dataentry-subform">
            endgame
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
    
  }
}
