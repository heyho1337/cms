<?php 
	$blog = $pdo->pdo_query1("SELECT * FROM ".$GLOBALS['DB_pref']."blog where blog_alias_".$GLOBALS['admin_lang']." =?",$sub_alias);
	if(isset($_POST['blog_mod_kuld'])){
		$lang_up = $pdo->pdo_query_simple("SELECT * FROM ".$GLOBALS['DB_pref']."langs");
		while($langs_up = $lang_up->fetch(PDO::FETCH_ASSOC)){
			if($_POST['blog_alias_'.$langs_up["langs_code"]] == NULL){
				$_POST['blog_alias_'.$langs_up["langs_code"]] = $basic->atalakit($_POST['blog_name_'.$langs_up["langs_code"]]);
			}else{
				$_POST['blog_alias_'.$langs_up["langs_code"]] = $_POST['blog_alias_'.$langs_up["langs_code"]];
			}
		}
		$lang_up2 = $pdo->pdo_query_simple("SELECT * FROM ".$GLOBALS['DB_pref']."langs");
		while($langs_up2 = $lang_up2->fetch(PDO::FETCH_ASSOC)){
			$pdo->pdo_up("UPDATE ".$GLOBALS['DB_pref']."blog SET 
			blog_name_".$langs_up2['langs_code']." = '".$_POST['blog_name_'.$langs_up2['langs_code']]."',
			blog_text_".$langs_up2['langs_code']." = '".$_POST['blog_text_'.$langs_up2['langs_code']]."'
			WHERE blog_id = '".$blog['blog_id']."'");
		}
		$date = date("Y-m-d H:i:s");
		$pdo->pdo_up("UPDATE ".$GLOBALS['DB_pref']."blog SET 
		blog_name = '".$_POST['blog_name']."',
		blog_date = '".$date."',
		blog_alias = '".$_POST['blog_alias']."',
		blog_sorrend = '".$_POST['blog_sorrend']."'
		WHERE blog_id = '".$blog['blog_id']."'");
		header("Location: ".$_SERVER['REQUEST_URI']); 
	}
?>
<form method="post" class="tab_form" enctype="multipart/form-data" action="">
	<ul class="tab_header">
		<li class="tab_1 tab_act"><?=$basic->fordito("settings",$GLOBALS['admin_lang']);?></li>
		<?php
			$lang_query = $pdo->pdo_query_simple("SELECT * FROM ".$GLOBALS['DB_pref']."langs");
			$i="1";
			while($langs = $lang_query->fetch(PDO::FETCH_ASSOC)){
				$i++?>
				<li class="tab_<?=$i;?>"><?=$langs['langs_name'];?> adatok</li><?php 
			}
		?>
	</ul>
	<div class="tab1_cont tab_cont tab_cont_act">
		<p class="form-group">
			<label><?=$basic->fordito("blog_name",$GLOBALS['admin_lang']);?></label>
			<input type="text" class="form-control" name="blog_name" value="<?=$blog['blog_name'];?>"/>
		</p>
		<p class="img_up form-group">
			<span class="img_title"><?=$basic->fordito("img_up",$GLOBALS['admin_lang']);?></span>
			<label><?=$basic->fordito("blog_kep",$GLOBALS['admin_lang']);?></label>
			<input class="kezdo_kep form-control"" type="file" name="blog_kep" />
		</p>
		<p class="form-group">
			<label><?=$basic->fordito("poz2",$GLOBALS['admin_lang']);?></label>
			<input class="form-control" type="text" name="blog_sorrend" value="<?=$blog['blog_sorrend'];?>"/>
		</p>
		<p class="form-group">
			<label><?=$basic->fordito("active",$GLOBALS['admin_lang']);?></label>
			<input type="checkbox" name="blog_active" id="blog_<?=$blog['blog_id'];?>" data-hover="blog" value="<?=$blog['blog_active'];?>" class="onoff" <?php if($blog['blog_active'] == "1"){ echo 'checked';}?> />
		</p>
	</div>
	<?php
		$lang_query = $pdo->pdo_query_simple("SELECT * FROM ".$GLOBALS['DB_pref']."langs");
		$i="1";
		while($langs = $lang_query->fetch(PDO::FETCH_ASSOC)){
			$i++?>
			<div class="tab<?=$i;?>_cont tab_cont">
				<button type="submit" class="blog_mod_kuld save_btn btn btn-block btn-primary" name="blog_mod_kuld"><i class="fa fa-floppy-o" aria-hidden="true"></i><span><?=$basic->fordito("save",$GLOBALS['admin_lang']);?></span></button>
				<button type="button" id="blog" class="cikk_mod_inline btn btn-block btn-primary" data-sub="<?=$sub_alias;?>" data-hover="<?=$langs['langs_code'];?>" name="blog_mod_inline"><i class="fa fa-eye" aria-hidden="true"></i><span><?=$basic->fordito("preview",$GLOBALS['admin_lang']);?></span></button>
				<p class="form-group">
					<label><?=$basic->fordito("blog_title",$GLOBALS['admin_lang']);?></label>
					<input type="text" class="form-control" name="blog_name_<?=$langs['langs_code'];?>" value="<?=$blog['blog_name_'.$langs['langs_code']];?>"/>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_alias",$GLOBALS['admin_lang']);?></label>
					<input type="text" class="form-control" name="blog_alias_<?=$langs['langs_code'];?>" value="<?=$blog['blog_alias_'.$langs['langs_code']];?>"/>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_bev",$GLOBALS['admin_lang']);?></label>
					<textarea class="form-control" name="blog_bev_<?=$langs['langs_code'];?>"><?=$blog['blog_bev_'.$langs['langs_code']];?></textarea>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_text",$GLOBALS['admin_lang']);?></label>
					<textarea id="article_text_<?=$langs['langs_code'];?>" name="blog_text_<?=$langs['langs_code'];?>"><?=$blog['blog_text_'.$langs['langs_code']];?></textarea>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_seo_title",$GLOBALS['admin_lang']);?></label>
					<textarea class="form-control" name="blog_seo_title_<?=$langs['langs_code'];?>"><?=$blog['blog_seo_title_'.$langs['langs_code']];?></textarea>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_meta_desc",$GLOBALS['admin_lang']);?></label>
					<textarea class="form-control" name="blog_meta_desc_<?=$langs['langs_code'];?>"><?=$blog['blog_meta_desc_'.$langs['langs_code']];?></textarea>
				</p>
				<p class="form-group">
					<label><?=$basic->fordito("blog_meta_keys",$GLOBALS['admin_lang']);?></label>
					<textarea class="form-control" name="blog_meta_keys_<?=$langs['langs_code'];?>"><?=$blog['blog_meta_keys_'.$langs['langs_code']];?></textarea>
				</p>
			</div><?php 
		}
	?>
</form>
<div class="inline_cont"></div>
<?php
	$lang_query = $pdo->pdo_query_simple("SELECT * FROM ".$GLOBALS['DB_pref']."langs");
	$i="1";
	while($langs = $lang_query->fetch(PDO::FETCH_ASSOC)){?>
		<script type="text/javascript">
			$(document).ready(function(){
				CKEDITOR.replace('article_text_<?=$langs['langs_code'];?>');
			});
		</script><?php 
	}
?>
<script type="text/javascript">
	$('document').ready(function(){
		var errors = false;
		var id = <?=$blog['blog_id'];?>;
		var blog_kep = { name: "<?=$blog['blog_kep'];?>",size: 200, type: 'image/jpeg' };
		var md = new Dropzone(".img_up", {
			url: "/hdcms/files/img_up.php",
			error: function(file, errorMessage) {
				errors = true;
			},
			init: function(){  
				this.options.addedfile.call(this, blog_kep);
				this.options.thumbnail.call(this, blog_kep, "/img/w0/h120/temp/<?=$GLOBALS['temp'];?>/images/blog/<?=$blog['blog_kep'];?>");
				blog_kep.previewElement.classList.add('dz-success');
				blog_kep.previewElement.classList.add('dz-complete');
			},
			sending:function(file, xhr, formData){
				formData.append('table', 'blog');
				formData.append('id', id);
				this.options.removedfile.call(this, blog_kep);
			},
			queuecomplete: function() {
			if(errors) console.log("There were errors!");
				else console.log("We're done!");
			},
			success: function(file, response){
                console.log(response);
            }
		});
	});
</script>






















