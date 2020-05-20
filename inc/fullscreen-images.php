<?php 
$fullscreen_image = get_field('fullscreen_image');
$mobile_image = get_field('mobile_image');

if( !empty($fullscreen_image) ): ?>

    <div id="hero" class="hero">
        <picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo $fullscreen_image['url']; ?>" alt="<?php echo $fullscreen_image['alt']; ?>" media="(min-width: 770px)">
            <!--[if IE 9]></video><![endif]-->
            <img id="fullscreen-image" srcset="<?php echo $mobile_image['url']; ?>" alt="<?php echo $fullscreen_image['alt']; ?>">
        </picture>  
        
        <?php if(get_field('image_credits')): ?>
        <div class="credits">
            <span>Image credit: </span><?php echo get_field('image_credits') ?>
        </div>
        <?php endif; ?>        
    </div>

<?php endif; ?>