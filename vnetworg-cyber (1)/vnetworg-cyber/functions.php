<?php
function vnetworg_cyber_setup() {
    add_theme_support('woocommerce');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'vnetworg-cyber'),
    ));
}
add_action('after_setup_theme', 'vnetworg_cyber_setup');

function vnetworg_cyber_widgets_init() {
    unregister_sidebar('sidebar-1');
}
add_action('widgets_init', 'vnetworg_cyber_widgets_init', 11);

function vnetworg_cyber_scripts() {
    wp_enqueue_style('vnetworg-cyber-style', get_stylesheet_uri(), array(), '1.8');
    // Load our new moving lines effect
    wp_enqueue_script('cyber-effects-js', get_template_directory_uri() . '/cyber-effects.js', array(), '1.8', true);
}
add_action('wp_enqueue_scripts', 'vnetworg_cyber_scripts');

function vnetworg_cyber_install_data() {
    if (get_option('vnetworg_cyber_data_installed_v1_8')) return;

    if (class_exists('WooCommerce')) {
        $products = array(
            'The One-Person Media Empire Blueprint' => array(
                'price' => '129.00',
                'desc' => "Stop creating content manually. Learn the exact algorithmic workflows to turn a single weekly video or podcast into 50+ optimized assets across every social platform using AI.\n\nWhat’s Included:\n\n- The Content Multiplier Notion OS\n- Voice & Tone Cloning Prompts\n- Automated Distribution Workflows"
            ),
            'The AI-Powered "Second Brain" Life OS' => array(
                'price' => '97.00',
                'desc' => "Offload your cognitive bandwidth. A comprehensive personal knowledge management system that uses AI to automatically categorize, summarize, and retrieve everything you read, watch, or think.\n\nWhat’s Included:\n\n- The Master Second Brain Template\n- The Auto-Tagging Setup Guide\n- The Weekly Review Automation"
            ),
            'The Freelancer’s AI Arbitrage Kit' => array(
                'price' => '149.00',
                'desc' => "Decouple your time from your income. A tactical playbook for freelancers on Upwork, Fiverr, and independent platforms to execute high-paying gigs 10x faster using specialized AI workflows.\n\nWhat’s Included:\n\n- The Arbitrage Niche Guide\n- Job-Completion Workflows\n- Client Management Templates"
            ),
            'The Algorithmic Wealth & Budget Dashboard' => array(
                'price' => '197.00',
                'desc' => "Your personal financial analyst. A sophisticated tracking system that uses AI to project your financial trajectory, track spending anomalies, and stress-test your investment portfolio.\n\nWhat’s Included:\n\n- The Interactive Financial Dashboard\n- Automated Bank Data Ingestion SOP\n- The Financial Health AI Prompt Library"
            ),
            'The Ghostwriter AI Protocol' => array(
                'price' => '79.00',
                'desc' => "Write like a top 1% copywriter without typing. The exact system to train LLMs on successful sales pages, email sequences, and viral threads to generate high-converting copy in minutes.\n\nWhat’s Included:\n\n- The Persuasion Framework Prompts\n- Email Sequence Generator Template\n- Landing Page Copy Architect"
            ),
            'The Automated Cold Email Outreach Engine' => array(
                'price' => '249.00',
                'desc' => "Never manually prospect again. A complete setup guide to building an AI-driven outreach system that finds leads, personalizes icebreakers, and books meetings while you sleep.\n\nWhat’s Included:\n\n- The Scrape & Clean Workflow\n- AI Personalization Scripts\n- The Inbox Deliverability Masterclass"
            ),
            'The Deep Work Focus Protocol' => array(
                'price' => '49.00',
                'desc' => "Reclaim your attention span. A neuro-optimized system combining analog techniques with AI tools to block distractions, enter flow states, and execute complex tasks without fatigue.\n\nWhat’s Included:\n\n- The Flow State Trigger Setup\n- AI Distraction Blocker Configs\n- The Cognitive Rest Playbook"
            )
        );

        foreach ($products as $title => $data) {
            $existing = get_page_by_title($title, OBJECT, 'product');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title' => $title,
                    'post_content' => $data['desc'],
                    'post_status' => 'publish',
                    'post_type' => 'product',
                ));
                wp_set_object_terms($post_id, 'simple', 'product_type');
                update_post_meta($post_id, '_visibility', 'visible');
                update_post_meta($post_id, '_price', $data['price']);
                update_post_meta($post_id, '_regular_price', $data['price']);
                update_post_meta($post_id, '_virtual', 'yes');
            }
        }
    }

    $pages = array(
        'Terms & Conditions' => "<h2>Terms and Conditions</h2>\n<p>Welcome to VNetworg. By accessing our private server and purchasing our proprietary AI configurations, templates, or digital goods, you explicitly agree to these strict conditions. You are purchasing a license for personal, non-transferable use. Distribution, resale, or reverse-engineering of the autonomous AI modules is strictly prohibited. We reserve the right to terminate access to any account found violating these terms without prior notice.</p>",
        'No Refund Policy' => "<h2>No Refund Policy</h2>\n<p>Due to the irreversible nature of digital goods and immediate access to proprietary AI source code and digital templates, <strong>all sales are absolutely final.</strong> VNetworg and Noir AI do not offer refunds, returns, or exchanges under any circumstances. By completing a purchase, you legally acknowledge and accept this strict no-refund policy.</p>",
        'Privacy Policy' => "<h2>Privacy Policy</h2>\n<p>Your data sovereignty is our top priority. We employ quantum-resistant encryption standards. We do not sell, rent, or lease your personal data to third parties. Data collected during checkout is used solely for payment processing and delivering digital goods to your designated email address.</p>",
        'Cookies Policy' => "<h2>Cookies Policy</h2>\n<p>We use essential cookies strictly to maintain your session state, authenticate your secure login, and process your cart. We do not use third-party tracking cookies or advertising pixels.</p>",
        'About' => "<h2>About VNetworg</h2>\n<p>VNetworg is a premier digital storefront specializing in autonomous artificial intelligence architectures. Engineered by Noir AI, our modules are designed to decouple your time from your income, offering enterprise-grade automation to solopreneurs and creators.</p>",
        'Contact' => "<h2>Contact Us</h2>\n<p>For technical support, custom deployment inquiries, or administrative assistance, please contact our encrypted support channel at: <strong>vnetworgsupport@hotmail.com</strong></p><p>Location: Bucharest Romania</p><p>We aim to respond to all inquiries within 24 hours.</p>"
    );

    foreach ($pages as $title => $content) {
        $page_check = get_page_by_title($title);
        if (isset($page_check->ID)) {
            wp_update_post(array(
                'ID'           => $page_check->ID,
                'post_content' => $content,
            ));
        } else {
            wp_insert_post(array(
                'post_title'   => $title,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ));
        }
    }

    $home_page = get_page_by_title('Home');
    if (!isset($home_page->ID)) {
        $home_id = wp_insert_post(array(
            'post_title'   => 'Home',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ));
    } else {
        $home_id = $home_page->ID;
    }

    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_id);

    $primary_menu_name = 'Main Nav';
    $primary_menu_exists = wp_get_nav_menu_object($primary_menu_name);

    if (!$primary_menu_exists) {
        $menu_id = wp_create_nav_menu($primary_menu_name);
    } else {
        $menu_id = $primary_menu_exists->term_id;
        $menu_items = wp_get_nav_menu_items($menu_id);
        foreach($menu_items as $item) { wp_delete_post($item->ID, true); }
    }

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' => __('Home'),
                                               'menu-item-url' => home_url('/'),
                                               'menu-item-status' => 'publish'
    ));

    $shop_page_id = get_option('woocommerce_shop_page_id');
    if ($shop_page_id) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Shop'),
                                                   'menu-item-object-id' => $shop_page_id,
                                                   'menu-item-object' => 'page',
                                                   'menu-item-type' => 'post_type',
                                                   'menu-item-status' => 'publish'
        ));
    }

    $cart_page_id = get_option('woocommerce_cart_page_id');
    if ($cart_page_id) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Cart'),
                                                   'menu-item-object-id' => $cart_page_id,
                                                   'menu-item-object' => 'page',
                                                   'menu-item-type' => 'post_type',
                                                   'menu-item-status' => 'publish'
        ));
    }

    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    update_option('vnetworg_cyber_data_installed_v1_8', true);
}
add_action('admin_init', 'vnetworg_cyber_install_data');

add_action('woocommerce_review_order_before_submit', 'vnetworg_add_no_refund_checkbox');
function vnetworg_add_no_refund_checkbox() {
    woocommerce_form_field('no_refund_policy', array(
        'type'          => 'checkbox',
        'class'         => array('form-row no_refund_policy'),
                                                     'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
                                                     'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
                                                     'required'      => true,
                                                     'label'         => 'I acknowledge that all digital sales are final and there are NO REFUNDS.',
    ));
}

add_action('woocommerce_checkout_process', 'vnetworg_no_refund_checkbox_warning');
function vnetworg_no_refund_checkbox_warning() {
    if (!isset($_POST['no_refund_policy'])) {
        wc_add_notice(__('You must acknowledge the No Refund Policy to proceed.'), 'error');
    }
}
?>
