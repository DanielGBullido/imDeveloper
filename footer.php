<footer id="colophon" class="blog-footer">
    <div class="site-info">
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'imdeveloper')); ?>"><?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf(esc_html__('Proudly powered by %s', 'imdeveloper'), 'WordPress');
            ?></a>
        <span class="sep"> | </span>
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf(esc_html__('Theme: %1$s by %2$s.', 'imdeveloper'), 'imdeveloper',
            '<a href="https://automattic.com/">Underscores.me</a>');
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div>
</div>
</main>
</body>
</html>
