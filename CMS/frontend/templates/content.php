<div id="article">
	<?php if($data['category'] != NULL){ ?><a href="<?php echo URL; ?>category/<?php echo $data['category']['categoryID']; ?>" id="category"><?php echo $data['category']['bezeichnung']; ?></a><?php } ?>
	<h1 id="heading"><?php echo $data['title']; ?></h1>
	<div id="content"><?php echo $data['inhalt']; ?></div>
	<?php if(isset($data['anhang'])) { ?>
		<div id="anhang">
                    <br />
			<a href="<?php echo BACKENDURL; ?>files/download.php?fileid=<?php echo $data['anhang']['dataID']; ?>"><?php echo $data['anhang']['name']; ?></a>
		</div>
	<?php } ?>
</div>