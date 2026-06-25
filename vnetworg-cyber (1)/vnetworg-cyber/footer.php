</div> <!-- .container -->
<footer>
<div class="footer-nav">
<?php
$policy_titles = array('Privacy Policy', 'Terms & Conditions', 'No Refund Policy', 'Cookies Policy', 'About', 'Contact');
foreach ($policy_titles as $title) {
    $page = get_page_by_title($title);
    if ($page) {
        echo '<a href="' . esc_url(get_permalink($page->ID)) . '" style="margin: 0 10px;">' . esc_html($title) . '</a>';
    }
}
?>
</div>
<div class="footer-contact">
<p>Location: Bucharest, Romania | Support: <a href="mailto:vnetworgsupport@hotmail.com" style="color:var(--accent-blue);">vnetworgsupport@hotmail.com</a></p>
</div>
<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Systems Operational. Powered by Noir AI.</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
