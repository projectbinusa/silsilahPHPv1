<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<form id="send-newmember" class="pt-mnewmember">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><?=$lang['newmember']['title']?></h4>
	      </div>
				<?php if ( fh_access('members', $id) ): ?>
      	<div class="modal-body">
					<div class="pt-form pt-forms">
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?=$lang['newmember']['personal']?></a></li>
					    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?=$lang['newmember']['contact']?></a></li>
					    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?=$lang['newmember']['biographical']?></a></li>
					    <li role="presentation"><a href="#pics" aria-controls="pics" role="tab" data-toggle="tab"><?=$lang['newmember']['pictures']?></a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="home">
								<div class="row">
									<div class="col-md-4">
										<label><?=$lang['newmember']['first']?><input type="text" placeholder="<?=$lang['newmember']['lab1']?>" name="firstname" /></label>
									</div>
									<div class="col-md-4">
										<label><?=$lang['newmember']['last']?><input type="text" placeholder="<?=$lang['newmember']['lab2']?>" name="lastname" /></label>
									</div>
									<div class="col-md-4">
										<label><?=$lang['newmember']['rtype']?></label>
										<select name="type">
											<option value="1"><?=$lang['newmember']['child']?></option>
											<option value="2"><?=$lang['newmember']['partner']?></option>
											<option value="3"><?=$lang['newmember']['ex']?></option>
											<option value="4"><?=$lang['newmember']['parent']?></option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<input class="choice" id="cb1" value="1" name="gender" type="radio"/>
										<label class="tgl-btn mr-2" for="cb1"><?=$lang['newmember']['female']?></label>
										<input class="choice" id="cb2" value="2" name="gender" type="radio"/>
										<label class="tgl-btn" for="cb2"><?=$lang['newmember']['male']?></label>
									</div>
									<div class="col">
										<div class="form-group mb-0">
											<input class="tgl tgl-light" id="cbs1" value="1" name="death" type="checkbox" checked/>
											<label class="tgl-btn mt-3" for="cbs1"></label>
											<label><?=$lang['newmember']['alive']?></label>
											<!-- <input class="choice" id="cb3" value="1" name="death" type="checkbox" checked/> -->
											<!-- <label class="tgl-btn mr-2" for="cb3"><?=$lang['newmember']['alive']?></label> -->
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col">
										<label><?=$lang['newmember']['bdate']?>:<br /><input type="text" name="birthdate" placeholder="00/00/0000" class="datepicker-here" data-language='en' data-position='top left' />
										</label>
									</div>
									<div class="col">
										<label><?=$lang['newmember']['mdate']?>:<br /><input type="text" name="mariagedate" placeholder="00/00/0000" class="datepicker-here" data-language='en' data-position='top left' />
										</label>
									</div>
									<div class="col">
										<label><?=$lang['newmember']['ddate']?>:<br /><input type="text" name="deathdate" placeholder="00/00/0000" class="datepicker-here" data-language='en' data-position='top left' />
										</label>
									</div>
								</div>

								<label class="link-u"><?=$lang['newmember']['link']?> <input type="text" class="form-control" name="user"></label>
								<label><?=$lang['newmember']['photo']?>:<input type="text" placeholder="<?=$lang['newmember']['photo_url']?>" name="photo" /></label>
								<div class="prt-group">
									<input type="file" name="poll_file" id="file" class="inputfile" />
									<label for="file"><i class="fa fa-upload"></i> <?=$lang['newmember']['choose']?></label>
								</div>
								<div class="form-avatar">
									<div class="form-group"><label class="tt"><span><?=$lang['newmember']['instead']?></span></label></div>
									<div class="form-inline">
										<?php for($x=1; $x<=18;$x++): ?>
										<div class="form-group">
											<input type="radio" name="avatar" value="<?=$x?>" id="sradioe<?=$x?>" class="choice image">
											<label for="sradioe<?=$x?>"><b><img src="<?=path?>/images/avatar/<?=$x?>.jpg" /></b></label>
										</div>
										<?php endfor; ?>
									</div>
								</div>
					    </div>
					    <div role="tabpanel" class="tab-pane" id="profile">
								<div class="row">
									<div class="col">
										<label>Facebook:<input type="text" placeholder="<?=$lang['newmember']['lab3']?>" name="facebook" /></label>
									</div>
									<div class="col">
										<label>Twitter:<input type="text" placeholder="<?=$lang['newmember']['lab4']?>" name="twitter" /></label>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label>Instagram:<input type="text" placeholder="<?=$lang['newmember']['lab5']?>" name="instagram" /></label>
									</div>
									<div class="col">
										<label>Email:<input type="text" placeholder="<?=$lang['newmember']['lab6']?>" name="email" />
										</label>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label><?=$lang['newmember']['tel']?>:<input type="text" placeholder="<?=$lang['newmember']['lab8']?>" name="tel" /></label>
									</div>
									<div class="col">
										<label><?=$lang['newmember']['mobile']?>:<input type="text" placeholder="<?=$lang['newmember']['lab9']?>" name="mobile" /></label>
									</div>
								</div>

								<label><?=$lang['newmember']['website']?>:<input type="text" placeholder="<?=$lang['newmember']['lab7']?>" name="site" /></label>


					    </div>
					    <div role="tabpanel" class="tab-pane" id="messages">
								<div class="row">
									<div class="col">
										<label><?=$lang['newmember']['bplace']?>:<input type="text" placeholder="<?=$lang['newmember']['lab10']?>" name="birthplace" /></label>
									</div>
									<div class="col">
										<label><?=$lang['newmember']['dplace']?>:<input type="text" placeholder="<?=$lang['newmember']['lab11']?>" name="deathplace" /></label>
									</div>
								</div>

								<label><?=$lang['newmember']['profession']?>:<textarea name="profession" placeholder="<?=$lang['newmember']['lab12']?>"></textarea></label>
								<label><?=$lang['newmember']['company']?>:<textarea name="company" placeholder="<?=$lang['newmember']['lab13']?>"></textarea></label>
								<label><?=$lang['newmember']['interests']?>:<textarea name="interests" placeholder="<?=$lang['newmember']['lab14']?>"></textarea></label>
								<label><?=$lang['newmember']['bio']?>:<textarea name="bio" placeholder="<?=$lang['newmember']['lab15']?>"></textarea></label>

					    </div>
					    <div role="tabpanel" class="tab-pane" id="pics">
								<?php if ( fh_access('albums') ): ?>
								<input id="images" name="images[]" type="file" multiple>
								<?php else: ?>
									<?php echo fh_alerts($lang['alerts']['albums'], 'warning') ?>
								<?php endif; ?>
					    </div>
					  </div>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$lang['close']?></button>
        <button type="submit" class="btn btn-primary"><?=$lang['submit']?></button>
				<input type="hidden" name="parent" />
				<input type="hidden" name="id" />
				<input type="hidden" name="nid" />
      </div>
		<?php else: ?>
			<div class="modal-body">
			<?php echo fh_alerts($lang['alerts']['members']) ?>
			</div>
		<?php endif; ?>
		</form>
    </div>
  </div>
</div>
