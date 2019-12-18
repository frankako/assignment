<?php declare (strict_types = 1);
get_header();

$generalPosts = new Wp_Query(array(
	'post_type' => 'post',
	'meta_query' => array(array(
		'key' => 'contact_details',
	),
		'key' => 'release_date',
	),
));?>

<div class="container">
      <div class="row">
 <?php while ($generalPosts->have_posts()) {
	$generalPosts->the_post();
	$metaContacts = rwmb_meta("contact_details");
	$metaReleaseDate = rwmb_meta("realease_date");
	$post_title = get_the_title();

	if ($post_title AND $metaContacts AND $metaReleaseDate) {
		?>
     <div class="col col-sm-12 col-md-6 mb-4">
       <h3 class="card-title"><?php echo get_the_title(); ?></h3>
           <div class="card">
		<?php foreach ($metaContacts as $contact) {?><!--The other way to do this is iteration-->
            <h5><span class="font-weight-bold">Release date:</span>&nbsp;<?php echo date('F j, Y', (int) $metaReleaseDate); ?></h5>
            <div class="card-body">
                     <p><span class="font-weight-bold">Contact Name:</span>&nbsp;<?php echo $contact['name']; ?></p>
                     <p><span class="font-weight-bold">Contact Email:</span>&nbsp;<?php echo $contact['email']; ?></p>
                     <p><span class="font-weight-bold">Contact Telephone:</span>&nbsp;<?php echo $contact['phone']; ?></p>
            </div>
      <?php }
	}
	?>
    </div>
  </div>
<?php
}?>
</div>
</div>
<?php get_footer();?>