<?php /* Template Name: Case Studies */ get_header(); ?>

<?php
$filter_groups = joulestowatts_case_study_filter_groups();
$stories       = joulestowatts_case_study_posts();
$filters       = get_field('filters') ?: array();
$settings      = get_field('stories') ?: array();
$per_page      = max( 1, (int) ( $settings['per_page'] ?? 9 ) );
$total         = count( $stories );
$shown         = min( $per_page, $total );
$count_text    = ! empty( $settings['count_text'] ) ? $settings['count_text'] : '%1$s of %2$s shown.';
$all_label     = ! empty( $filters['all_label'] ) ? $filters['all_label'] : 'All';
?>

<section class="csListSec" data-case-studies data-per-page="<?php echo esc_attr( $per_page ); ?>">
    <div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="csListHeading">
                    <?php if( get_sub_field('sub_heading') ): ?>
                        <h4 class="manrope"><?php echo esc_html( get_sub_field('sub_heading') ); ?></h4>
                    <?php endif; ?>
                    <h1 class="manrope"><?php echo esc_html( get_sub_field('heading') ); ?></h1>
                    <div class="description"><?php echo wp_kses_post( get_sub_field('description') ); ?></div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <div class="csFilters">
            <?php foreach ( $filter_groups as $name => $group ) :
                $choices = joulestowatts_case_study_filter_choices( $name );
                if ( ! $choices ) {
                    continue;
                }
                $label = ! empty( $filters[ $group[0] ] ) ? $filters[ $group[0] ] : $group[1];
                ?>
                <div class="csFilterRow" data-filter-group="<?php echo esc_attr( $name ); ?>" role="group" aria-label="<?php echo esc_attr( $label ); ?>">
                    <span class="csFilterLabel"><?php echo esc_html( $label ); ?></span>
                    <div class="csFilterChips">
                        <button type="button" class="csChip is-active" data-filter-value="" aria-pressed="true"><?php echo esc_html( $all_label ); ?></button>
                        <?php foreach ( $choices as $value => $choice_label ) : ?>
                            <button type="button" class="csChip" data-filter-value="<?php echo esc_attr( $value ); ?>" aria-pressed="false"><?php echo esc_html( $choice_label ); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="csResults">
            <p class="csCount" aria-live="polite">
                <span data-count-text="<?php echo esc_attr( $count_text ); ?>"><?php echo esc_html( sprintf( $count_text, $shown, $total ) ); ?></span>
                <?php if ( ! empty( $settings['library_text'] ) ) : ?>
                    <span><?php echo esc_html( $settings['library_text'] ); ?></span>
                <?php endif; ?>
            </p>

            <div class="csGrid">
                <?php foreach ( $stories as $index => $story ) :
                    $card = get_field( 'card', $story->ID ) ?: array();
                    $tags = get_field( 'filters', $story->ID ) ?: array();
                    $data = '';
                    foreach ( array_keys( $filter_groups ) as $name ) {
                        $data .= sprintf( ' data-%s="%s"', esc_attr( str_replace( '_', '-', $name ) ), esc_attr( wp_json_encode( array_values( (array) ( $tags[ $name ] ?? array() ) ) ) ) );
                    }
                    ?>
                    <a href="<?php echo esc_url( get_permalink( $story ) ); ?>" class="csCard<?php echo $index >= $per_page ? ' is-hidden' : ''; ?>" data-case-card<?php echo $data; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above ?>>
                        <div class="csCardTop">
                            <div class="csMetric manrope">
                                <span class="value"><?php echo esc_html( ( $card['metric'] ?? '' ) ?: get_the_title( $story ) ); ?></span>
                                <?php if ( ! empty( $card['metric_suffix'] ) ) : ?>
                                    <span class="suffix"><?php echo esc_html( $card['metric_suffix'] ); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ( ! empty( $card['summary'] ) ) : ?>
                                <p class="manrope"><?php echo esc_html( $card['summary'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ( ! empty( $card['tags'] ) ) : ?>
                            <ul class="csCardTags manrope">
                                <?php foreach ( $card['tags'] as $tag ) : ?>
                                    <li><?php echo esc_html( $tag['label'] ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <p class="csEmpty"<?php echo $total ? ' hidden' : ''; ?>><?php echo esc_html( ! empty( $settings['empty_text'] ) ? $settings['empty_text'] : 'No stories match these filters yet.' ); ?></p>

            <div class="csMore"<?php echo $total > $per_page ? '' : ' hidden'; ?>>
                <button type="button" class="secondaryCTA" data-show-more><span><?php echo esc_html( ! empty( $settings['show_more_text'] ) ? $settings['show_more_text'] : 'Show more Customer Impact Stories' ); ?></span>
                    <div class="arrowBox">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M6.5 9.25L12 14.75L17.5 9.25" stroke="#12161F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <div class="csListLines" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/case-study-lines-left.webp" alt="" class="linesLeft" loading="lazy">
        <img src="<?php echo get_template_directory_uri(); ?>/images/case-study-lines-right.webp" alt="" class="linesRight" loading="lazy">
    </div>
</section>

<?php get_footer(); ?>
