<?php
/*-----------------------------------------------------------------------------------*/
/*	Calculate Score
/*-----------------------------------------------------------------------------------*/

function gm_calculate_score($num, $type, $star = false) {
		
		switch ($type) :
		
			case 'star' :
				if(!$star == false){
					if ( $num <= 2 ) $output = '<span class="badge-star" title="1 star"><i class="fa fa-star"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i></span>';
					if ( $num > 2 && $num <= 4 ) 
					$output = '<span class="badge-star" title="2 stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i></span>';
					if ( $num > 4 && $num <= 6 )
					$output = '<span class="badge-star" title="3 stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-empty"></i><i class="fa fa-star-empty"></i></span>';
					if ( $num > 6 && $num <= 8 ) 
					$output = '<span class="badge-star" title="4 stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-empty"></i></span>';
					if ( $num > 8 && $num <= 10 ) 
					$output = '<span class="badge-star" title="5 stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>';
				} else {
					$output = $num;
				}
				break;
			
			case 'letter' :
				if ( $num <= 2 ) $output = 'E';
				if ( $num > 2 && $num <= 4 ) $output = 'D';
				if ( $num > 4 && $num <= 6 ) $output = 'C';
				if ( $num > 6 && $num <= 8 ) $output = 'B';
				if ( $num > 8 && $num <= 10 ) $output = 'A';
				break;
			
			case 'number';
				$output = $num;
				break;
			
		endswitch;
		
		return $output;
}


/*-----------------------------------------------------------------------------------*/
/*	Review System Box
/*-----------------------------------------------------------------------------------*/

function gm_print_review_box($post_id, $class, $echo = true) {
		
		$review_box_title = get_post_meta( $post_id, 'gm_' . 'review_box_title', true );
		$review_box_total_score_label = get_post_meta( $post_id, 'gm_' . 'review_box_total_score_label', true );
		$review_summary = get_post_meta( $post_id, 'gm_' . 'review_summary', true );
		
		$rating_type = get_post_meta( $post_id, 'gm_' . 'rating_type', true );
		$rating_criteria = get_post_meta( $post_id, 'gm_' . 'rating_criteria', true );
		$rating_criteria_count =  count($rating_criteria);
		$author = get_the_author();
		$pfx_date = get_the_date();

				$score_array = array();
			foreach ($rating_criteria as $criteria) {
				$score_array []= $criteria['score'];
			}
			$final_score = array_sum($score_array);
			$final_score = $final_score / $rating_criteria_count;
			$final_score = number_format($final_score, 1, '.', '');
		
		$output = '';
		$output .= '<div id="review-box" itemscope itemtype="http://data-vocabulary.org/Review">';
		$output .= '<span class="reviewer" itemprop="reviewer" style="display:none;">'.$author.'</span>';
		$output .= '<time class="dtreviewed" itemprop="dtreviewed" style="display:none;">'.$pfx_date.'</time>';
		$output .= '<span class="summary" itemprop="summary" style="display:none;">'.$review_summary.'</span>';
		$output .= '<span class="rating" style="display: none;" itemprop="rating">'. gm_calculate_score($final_score, true).'';
		$output .= '<span itemprop="worst">1</span><span itemprop="best">10</span></span>';
		$output .= '<div class="review-top"><div class="review-text">';
		$output .= '<span itemprop="itemreviewed" class="review-title">'.$review_box_title.'</span>';
		$output .= '<p>'.$review_summary.'</p>';
		$output .= '</div></div></ul>';
		$output .= '<ul><li><div class="review-criteria-bar-container"><div class="review-criteria-bar" style="width: 100%"><div class="rating-line"></div><div class="gmgp final-score">Ortalama Puan</div><span class="right finalScore">'. gm_calculate_score($final_score, $rating_type, true).'</span></div></div></li>';
			foreach ($rating_criteria as $criteria) {
				$percentage_score = $criteria['score'] * 10;
				if($criteria['c_label'])
				$output .= '<li><div class="review-criteria-bar-container"><div class="review-criteria-bar" style="width:'.$percentage_score.'%"><div class="rating-line"></div><div class="gmgp">'.$criteria['c_label'].'</div><span class="right">'.gm_calculate_score($criteria['score'], $rating_type, true).'</span></div></div></li>';
			}

		$output .= '</ul></div>';
   
		
		if($echo == 'true') :
		echo $output;
		else :
		return $output;
		endif;
}


/*-----------------------------------------------------------------------------------*/
/*	Display Review Badge
/*-----------------------------------------------------------------------------------*/

function gm_print_review_badge($post_id, $echo = true) {
		
		$rating_type = get_post_meta( $post_id, 'gm_' . 'rating_type', true );
		$rating_criteria = get_post_meta( $post_id, 'gm_' . 'rating_criteria', true );
		$rating_criteria_count =  count($rating_criteria);
		
		$output = '';
		$score_array = array();
		
		if($rating_criteria){
			foreach ($rating_criteria as $criteria) {
				$score_array []= $criteria['score'];
			}
		}
		
		$final_score = array_sum($score_array);
		$final_score = $final_score / $rating_criteria_count;
		$final_score = number_format($final_score, 1, '.', '');
		
		$output = '<div class="gm-review-badge review-badge-'.$rating_type.'"><span>'.gm_calculate_score($final_score, $rating_type, true).'</span></div>';
    
		if($echo == 'true') :
		echo $output;
		else :
		return $output;
		endif;
}

