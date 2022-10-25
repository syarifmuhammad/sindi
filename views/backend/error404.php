<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content">
	<?php if ($this->session->user_type === 'super_user') { ?>
	<div class="callout callout-danger">
		<h4><?=$title;?></h4>
		Maaf, Halaman <code><?=current_url();?></code> tidak ditemukan.
	</div>
	<?php } else { ?>
	<div class="callout callout-danger">
		<h4><?=$title;?></h4>
		Maaf, Halaman <code><?=current_url();?></code> tidak ditemukan.
	</div>
	<? } ?>
</section>
