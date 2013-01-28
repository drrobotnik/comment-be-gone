Comments Be Gone!
===============
![alt text](https://raw.github.com/drrobotnik/comment-be-gone/master/3sr2rf.jpeg "Wizards don't like comments...")

Specifically created to remove PHP and HTML comments from "skeleton" frameworks. Your skeletons are too chatty...

Why?
====

**Because this is absurd…**

	<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of loop, in case you forgot. ?>

			</div><!-- #content .site-content (unnecessary w/proper indenting) -->
		</div><!-- #primary .content-area -->

In the case of skeleton frameworks, where I'm going to take it, remove most of the code for each of my projects you're adding unnecessary safety nets.

Keep in Mind
============
This is intended to run in the directory of the PHP files you want to clean out. It does not run recursively, so you'll need to run the script in each folder.

**Most importantly:** There are no safety measures set. The script runs when you hit enter so absolutely do not run this on code before fully understanding that you're batch modifying code on a folder basis. There is no revert. 

That's what git's for :)