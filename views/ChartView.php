<?php 
class ChartView implements View 
{
	public function render()
	{ ?>
		<div class="popup-section">
			<div class="popup-section-content">
				<div class="popup-section-exit"></div>
				<div id="pop-up" class="page-section-head">
					Text
				</div>
				<div class="page-section-content">
					<canvas id="statsChart"></canvas>
				</div>
			</div>
		</div>
	<?php }		
}