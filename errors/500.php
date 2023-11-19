<?php
/*
Template Name: 500 Page
*/
get_header();
?>

<body class="bg-dark">

<div class="container full-height-centered">
	<main id="error-calltoaction" class="row">

		<?php

		call_to_action(
			500,
			'Oops! Looks like the foxes broke something important!',
			'It looks like we are experiencing some issues on our server. '
			. 'This is on our end so please be patient for the issue to be resolved. We are doing our best!<br/>'
			. 'In the meantime, check out our <a href="https://www.youtube.com/channel/UCQXtm37PWIjf8lvzBVZz_JQ">YouTube Channel</a>.',
			null,
			null,
			true
		);

		?>

	</main>
</div>

</body>