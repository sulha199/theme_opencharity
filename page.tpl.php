<div id="wrapper">
    <nav id="myTopnav" class="">
        <div class="container">
            <a href="<?php print $front_page; ?>" id="sitelogo">
                <?php if ($logo): { ?>
                        <img src="<?php print $logo ?>" alt="<?php print $site_name . $site_slogan ?>" title="<?php print $site_name . $site_slogan ?>" id="logo" />
                    <?php }else : { ?>
                        <img src="/<?php print $directory; ?>/images/logo.png" alt="<?php print $site_name; ?>" height="80" width="150" />
                        <?php
                    }
                endif;
                ?>

            </a>      

            <?php if ($page['nav']): ?>    
                <?php print render($page['nav']); ?>
            <?php endif; ?> 
            <a href="javascript:void(0);" class="icon" onclick="responsive_menu()">&#9776;</a>
        </div>
    </nav>

    <header>
        <?php if ($page['header']): ?>    
            <?php print render($page['header']); ?>
        <?php endif; ?>  
    </header>

    <div id="after-header">
        <div class="container">
            <?php if ($page['after_header']): ?>
                <?php print render($page['after_header']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="before-content">
        <div class="container">
            <?php if ($page['before_content']): ?>
                <?php print render($page['before_content']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="main">
        <div id="content" <?php if ($page['sidebar_first']) echo 'style="margin-right:200px;"'; ?>>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?><h1><?php print $title; ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>

            <?php print render($messages); ?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

            <?php print render($page['content']); ?>
        </div>

        <?php if ($page['sidebar_first']): ?>    
            <div id="sidebar">
                <?php print render($page['sidebar_first']); ?>
            </div>
        <?php endif; ?>  
    </div>

    <div id="after-content">
        <div class="container">
            <?php if ($page['after_content']): ?>
                <?php print render($page['after_content']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="before-footer">
        <div class="container">
            <?php if ($page['before_footer']): ?>
                <?php print render($page['before_footer']); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <?php if ($page['footer']): ?>    
            <?php print render($page['footer']); ?>
        <?php endif; ?>              
    </div>
</footer>