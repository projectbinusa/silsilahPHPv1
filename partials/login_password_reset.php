<!-- Modal View Member  -->
<div class="modal fade" id="resetM" tabindex="-1" role="dialog" aria-labelledby="ResetMLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="send-reset-password" class="pt-mnewmember">
			<div class="modal-header">
				<h5 class="modal-title"><?=$lang['resetpage']['title1']?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<label class="link-u">
					<i class="fas fa-lock"></i>
					<input type="text" class="form-control" name="reset_email" placeholder="<?=$lang['resetpage']['email']?>">
				</label>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><?=$lang['submit']?></button>
			</div>
			</form>
		</div>
	</div>
</div>
