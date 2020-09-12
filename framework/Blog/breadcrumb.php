<?php
/*
Sayfa Adı: Breadcrumb
@link httpss://developer.wordpress.org/themes/basics/template-files/#template-partials
@url kanthemes.com
*/
	$home_url = home_url(); 
	echo "<ol id='breadcrumbs' itemscope itemtype='https://schema.org/BreadcrumbList'>";
		echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="root">';
			echo '<a itemprop="item" class="active waves-effect btn" href="'.$home_url.'">';
				echo '<span itemprop="name">'.__( "Ana Sayfa","geo").'</span>';
			echo '</a>';
			echo '<meta itemprop="position" content="1" />';
		echo '</li>';
		if (is_category() || is_single()) {
			$categories = get_the_category();
			$output = '';
			if($categories){
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a class="waves-effect waves-light btn twitter" href="'.get_category_link( $categories[0]->term_id ).'" itemprop="item"><span itemprop="name">'.$categories[0]->cat_name.'</span></a>
					<meta itemprop="position" content="2" />
				</li>';
			}
		} elseif (is_page()) {
			echo "<li itemprop='itemListElement' itemscope
				itemtype='https://schema.org/ListItem'>";
					the_title( '<a class="waves-effect waves-light btn twitter" href="' . esc_url( get_permalink() ) . '" itemprop="item"><span itemprop="name">', '</span></a>' );
			echo "<meta itemprop='position' content='2' /></li>";
		}
	echo "</ol>";
