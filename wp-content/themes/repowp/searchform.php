<span class="menu-desktop__searchform__action icon-magnifying-glass" data-search></span>
<form role="search" method="get" id="searchform"
    class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-form-menu>
    <div class="search-content">
        <label class="screen-reader-text" for="s"><?php _e( 'Ricerca', 'my_website' ) ?></label>
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" data-search-input />
        <button type="submit">
       		<span class="icon-magnifying-glass"></span>
        </button>
    </div>
</form>