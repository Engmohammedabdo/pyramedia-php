<?php
/**
 * Schema Markup Functions
 */

function get_organization_schema() {
    return [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => SITE_NAME,
        "url" => "http://pyramedia.72.61.148.81.sslip.io",
        "logo" => "http://pyramedia.72.61.148.81.sslip.io/assets/logo.png",
        "description" => SITE_DESCRIPTION,
        "address" => [
            "@type" => "PostalAddress",
            "addressCountry" => "AE",
            "addressLocality" => "United Arab Emirates"
        ],
        "contactPoint" => [
            "@type" => "ContactPoint",
            "telephone" => CONTACT_PHONE,
            "contactType" => "customer service",
            "email" => CONTACT_EMAIL,
            "availableLanguage" => ["ar", "en"]
        ],
        "sameAs" => [
            SOCIAL_FACEBOOK,
            SOCIAL_INSTAGRAM,
            SOCIAL_TWITTER,
            SOCIAL_LINKEDIN
        ]
    ];
}

function get_local_business_schema() {
    return [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => SITE_NAME,
        "image" => "http://pyramedia.72.61.148.81.sslip.io/assets/logo.png",
        "url" => "http://pyramedia.72.61.148.81.sslip.io",
        "telephone" => CONTACT_PHONE,
        "email" => CONTACT_EMAIL,
        "address" => [
            "@type" => "PostalAddress",
            "addressCountry" => "AE",
            "addressLocality" => "United Arab Emirates"
        ],
        "priceRange" => "999 AED - 4999 AED",
        "openingHoursSpecification" => [
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday"],
            "opens" => "09:00",
            "closes" => "18:00"
        ],
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "4.9",
            "reviewCount" => "200"
        ]
    ];
}

function get_website_schema() {
    return [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => SITE_NAME,
        "url" => "http://pyramedia.72.61.148.81.sslip.io",
        "description" => SITE_DESCRIPTION,
        "potentialAction" => [
            "@type" => "SearchAction",
            "target" => [
                "@type" => "EntryPoint",
                "urlTemplate" => "http://pyramedia.72.61.148.81.sslip.io/search?q={search_term_string}"
            ],
            "query-input" => "required name=search_term_string"
        ]
    ];
}

function get_breadcrumb_schema($items) {
    $listItems = [];
    foreach ($items as $index => $item) {
        $listItems[] = [
            "@type" => "ListItem",
            "position" => $index + 1,
            "name" => $item['name'],
            "item" => $item['url']
        ];
    }
    
    return [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => $listItems
    ];
}

function get_faq_schema($faqs) {
    $mainEntity = [];
    foreach ($faqs as $faq) {
        $mainEntity[] = [
            "@type" => "Question",
            "name" => $faq['question'],
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $faq['answer']
            ]
        ];
    }
    
    return [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => $mainEntity
    ];
}

function render_schema($schema) {
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}

function render_og_tags($title, $description, $image = null, $url = null) {
    $image = $image ?? 'http://pyramedia.72.61.148.81.sslip.io/assets/og-image.jpg';
    $url = $url ?? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($url); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
    <meta property="og:locale" content="ar_AE">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo htmlspecialchars($url); ?>">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta property="twitter:image" content="<?php echo htmlspecialchars($image); ?>">
    <?php
}
?>

