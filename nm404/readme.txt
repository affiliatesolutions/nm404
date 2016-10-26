=== nm404 ===

Contributors: affiliatesolutions
Tags: error redirect, 404 seo, 404 to 301, 404, 301, 302, 307, not found, 404 redirect, 301 redirect, seo redirect, custom 404 page
Requires at least: 4.5
Tested up to: 4.6
Stable tag: 2.0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Avoid any 404 File not found errors on your WordPress-Site by redirecting the request to the closest match found in the sitemap.xml.
Optimize your SEO rankings and keep users happy by serving alternative content of 404 File not found requests.

If a request will end up in a 404 error, this plugin redirects the request to the closest similar spelling url in your blog.
The 301 redirect is done by using the "Levenshtein distance algorithm" to find the closest match.
The recommended plugin to generate the required sitemap.xml for nm404 is [Better WordPress Google XML Sitemap](https://wordpress.org/plugins/bwp-google-xml-sitemaps/ "Better WordPress Google XML Sitemap").

= Advantages =

* no more 404 errors
* no manual configuration necessary
* better search results
* better seo ranking
* better browsing experience on your website
* statistics of 404 error requests / redirects

= Plugin is translated in =

* English
* German

== Installation ==

* Install any sitemap plugin like [Better WordPress Google XML Sitemap](https://wordpress.org/plugins/bwp-google-xml-sitemaps/ "Better WordPress Google XML Sitemap") to generate the needed sitemap.xml for nm404
* Activate the plugin nm404
* Optionally configure the settings of nm404 for better speed or better result

== Frequently Asked Questions ==

= How do I configure "no more 404"? =

You can set the URL of you sitemap.xml and the number of records to be parsed in the admin backend. No more configuration is required.
It simply does what it is supposed to.

= Why some redirections seem to take too long? =

For some blogs with more than 10000 articles for example, it could take a little bit to search on that larger sitemap.xml the appropiate match for the request.
To avoid a delay you may either cache your sitemap.xml (e.g. through varnish) or put a static sitemap.xml in your document-root.

= Will the plugin get any enhancements in future? =

We are continuously improving this plugin. In future it will be possible to configure some nice options, so stay tuned!


== Screenshots ==

1. nm404 Configuration

== Changelog ==

= 2.0.9 =

* Statistics Improvement

= 2.0.7 =

* Updated Support Page

= 2.0.5 =

* Admin Layout Update / Added Video Tutorial

= 2.0.3 =

* fixed bug in queue logic

= 2.0.2 =

* fixed typo


= 2.0.1 =

* bugfix

= 2.0.0 =
* reworked nm404 public release
