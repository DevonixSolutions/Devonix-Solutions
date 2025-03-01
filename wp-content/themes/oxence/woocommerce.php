<?php
/**
 * Custom Woocommerce shop page.
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

get_header();
?>

<div class="<?php Helper::container_class()?>">
    <div class="content-wrapper no-sidebar">
        <div class="content-area">
            <?php woocommerce_content();?>
        </div>
    </div>
</div>

<?php
get_footer();