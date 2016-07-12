<div class="user-panel">
	
	<ul class="custom-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" target="_self">Профил</a>
		</li>
		<li role="presentation">
			<a href="#user-tabs" aria-controls="user-tabs" role="tab" data-toggle="tab" target="_self">Качени таблатури</a>
		</li>
		<li role="presentation">
			<a href="#user-favourites" aria-controls="user-favourites" role="tab" data-toggle="tab" target="_self">Любими таблатури</a>
		</li>
		<li role="presentation">
			<a href="#user-search" aria-controls="user-search" role="tab" data-toggle="tab" target="_self">Търси потребители</a>
		</li>
		<li role="presentation">
			<a href="#add-article" aria-controls="add-article" role="tab" data-toggle="tab" target="_self">Качи новина</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<?php include "_profile.php" ?>
		<?php include "_user-tabs.php" ?>
		<?php include "_user-favourites.php" ?>
	</div>

</div>