# nm404

## no more 404

Avoid any 404 File not found errors on your WordPress-Site by redirecting the request to the closest match found in the sitemap.xml.
Optimize your SEO rankings and keep users happy by serving alternative content of 404 File not found requests.

If a request will end up in a 404 error, this plugin redirects the request to the closest similar spelling url in your blog.
The 301 redirect is done by using the "Levenshtein distance algorithm" to find the closest match.
The recommended plugin to generate the required sitemap.xml for nm404 is <a href="https://wordpress.org/plugins/bwp-google-xml-sitemaps/" target="_blank">Better WordPress Google XML Sitemap</a>.

### Advantages

* no more 404 errors
* no manual configuration necessary
* better search results
* better seo ranking
* better browsing experience on your website
* statistics of 404 error requests / redirects

### Plugin is translated in

* English
* German

## Contents

- [Installation](#installation)
- [Frequently Asked Questions](#faq)
- [Changelog](#changelog)


More infos about this project on <a href="https://www.affiliate-solutions.xyz/produkte/nomore404/" target="_blank">www.affiliate-solutions.xyz</a>

<a name="installation"></a>
## Installation

* Install any sitemap plugin like <a href="https://wordpress.org/plugins/bwp-google-xml-sitemaps/" target="_blank">Better WordPress Google XML Sitemap</a> to generate the needed sitemap.xml for nm404
* Activate the plugin nm404
* Optionally configure the settings of nm404 for better speed or better result

<a name="faq"></a>
## Frequently Asked Questions

### How do I configure "no more 404"?

> You can set the URL of you sitemap.xml and the number of records to be parsed in the admin backend. No more configuration is required.
> It simply does what it is supposed to.

### Why some redirections seem to take too long?

> For some blogs with more than 10000 articles for example, it could take a little bit to search on that larger sitemap.xml the appropiate match for the request.
> To avoid a delay you may either cache your sitemap.xml (e.g. through varnish) or put a static sitemap.xml in your document-root.

### Will the plugin get any enhancements in future?

> We are continuously improving this plugin. In future it will be possible to configure some nice options, so stay tuned!

<a name="changelog"></a>
## Changelog

### 2.0.9

* Statistics Improvement

### 2.0.7

* Updated Support Page

### 2.0.5

* Admin Layout Update / Added Video Tutorial

### 2.0.3

* fixed bug in queue logic

### 2.0.2

* fixed typo

### 2.0.1

* bugfix

### 2.0.0
* reworked nm404 public release
