<?php
class DataEntryFormView implements View
{  
  public function render()
  { $data_definitions = (new DataDefinitionsDatabaseModel())->getDataDefinitions(); ?>
    <div class="page-section">
      <div class="page-section-head">
        Pre-Match Information
      </div>
      <div class="page-section-content">
        <div class="dataentry-module">
          Match Number<br>
          <input id="match_number" type="num" class="dataentry-module-number"></input>
        </div>
        <div class="dataentry-module">
          Team Number<br>
          <input id="team_number" type="num" class="dataentry-module-number"></input>
        </div>
        <div class="dataentry-module">
          Dead?<br>
          <input id="dead" type="checkbox" class="dataentry-module-boolean"></input>
        </div>
        <div class="dataentry-module">
          Dead for part of match?<br>
          <input id="dead_shortly" type="checkbox" class="dataentry-module-boolean"></input>
        </div>
      </div>
    </div>
    <div class="page-section">
      <div class="page-section-head">
        Autonomous
      </div>
      <div class="page-section-content">
        <?php foreach($data_definitions as $definition) { 
          if($definition['section'] == 0) { ?>
            <div class="dataentry-module">
              <?= $definition['title'] ?><br>
              <?= $this->getInputByDefinition($definition) ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="page-section">
      <div class="page-section-head">
        Teleop
      </div>
      <div class="page-section-content">
        <?php foreach($data_definitions as $definition) { 
          if($definition['section'] == 1) { ?>
            <div class="dataentry-module">
              <?= $definition['title'] ?><br>
              <?= $this->getInputByDefinition($definition) ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="page-section">
      <div class="page-section-head">
        End Game
      </div>
      <div class="page-section-content">
        <?php foreach($data_definitions as $definition) { 
          if($definition['section'] == 2) { ?>
            <div class="dataentry-module">
              <?= $definition['title'] ?><br>
              <?= $this->getInputByDefinition($definition) ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="page-section">
      <div class="page-section-head">
        Comments
      </div>
      <div class="page-section-content">
        <?php foreach($data_definitions as $definition) { 
          if($definition['section'] == 3) { ?>
            <div class="dataentry-module">
              <?= $definition['title'] ?><br>
              <?= $this->getInputByDefinition($definition) ?>
            </div>
          <?php } ?>
        <?php } ?>
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
