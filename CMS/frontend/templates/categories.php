Artikel in der Kategorie "<?php echo $data['category']; ?>":
<ul>
<?php foreach($data['artikel'] as $article){ ?>
	<li><a href="<?php echo URL; echo $article['URL']; ?>"><?php echo $article['titel']; ?></a></li>
<?php } ?>
</ul>