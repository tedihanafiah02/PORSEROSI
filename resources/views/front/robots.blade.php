User-agent: *
Allow: /
Disallow: /admin/
Disallow: /login
Disallow: /register
Disallow: /password
Disallow: /storage/
Disallow: /api/
Disallow: /_debugbar/

# Crawl-delay for polite crawling
Crawl-delay: 1

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}
