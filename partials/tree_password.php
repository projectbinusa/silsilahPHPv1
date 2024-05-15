<div class="pt-box pt-vpass">
	<h4><?=$lang['treepage']['vp_t']?></h4>
	<p><?=$lang['treepage']['vp_p']?></p>

	<form class="pt-form" id="send-vpass">
		<div class="pt-input">
			<i class="fas fa-key"></i>
			<input type="password" name="vpass" placeholder="<?=$lang['treepage']['vp_i']?>">
		</div>
		<hr />
		<button type="submit" class="pt-button bg-0"><i class="fas fa-sign-in-alt"></i> <?=$lang['treepage']['vp_b']?></button>
		<input type="hidden" name="id" value="<?=$id?>" />
	</form>
</div>
