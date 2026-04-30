#!/usr/bin/env python3
"""Build WordPress WXR from viviceramic static HTML. Run: python3 build_wxr.py"""
from __future__ import annotations

import re
import xml.sax.saxutils as xmlu
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
OUT = Path(__file__).resolve().parent

# WordPress permalink placeholders (edit after import if your slugs differ)
REPLACEMENTS = [
    ('href="index.html"', 'href="/"'),
    ('href="about.html"', 'href="/about/"'),
    ('href="products/all.html"', 'href="/shop/"'),
    ('href="resources/blog.html"', 'href="/resources/blog/"'),
    ('href="resources.html"', 'href="/resources/"'),
    ('href="contact.html"', 'href="/contact/"'),
    ('href="login.html"', 'href="/login/"'),
    ('src="images/logo-icon.png"', 'src="/wp-content/themes/hallowceramics-auto-pages/assets/images/logo-icon.png"'),
    ('src="images/logo-text.png"', 'src="/wp-content/themes/hallowceramics-auto-pages/assets/images/logo-text.png"'),
    ('src="./pumpkin_alpha.webm"', 'src="/wp-content/uploads/viviceramic/pumpkin_alpha.webm"'),
    ('<link rel="stylesheet" href="css/styles.css" />', ""),
]


def wp_apply_links(html: str) -> str:
    for a, b in REPLACEMENTS:
        html = html.replace(a, b)
    return html


def extract_home_body(html: str) -> str:
    """Intro + header + main + footer + lightbox (no script)."""
    intro_start = html.find('<div class="intro-screen"')
    header_start = html.find('<header class="site-header">')
    if intro_start < 0 or header_start < 0:
        raise RuntimeError("Could not find intro/header in index.html")
    intro = html[intro_start:header_start]

    main_start = html.find("<main>")
    main_end = html.find("</main>") + len("</main>")
    if main_start < 0 or main_end < len("</main>"):
        raise RuntimeError("Could not find main in index.html")
    main = html[main_start:main_end]

    fh = html.find("<footer", main_end)
    fe = html.find("</footer>", fh) + len("</footer>")
    if fh < 0 or fe < len("</footer>"):
        raise RuntimeError("Could not find footer in index.html")
    footer = html[fh:fe]

    lb = re.search(r'<div class="lightbox"[\s\S]*?</div>\s*</div>', html[fe:])
    lightbox = lb.group(0) if lb else ""

    header = html[header_start:main_start]
    inner = intro + header + main + footer + lightbox
    inner = inner.replace("ViviCeramics", "HallowCeramics")
    inner = inner.replace("viviceramics-lang", "hallowceramics-lang")
    return wp_apply_links(inner)


def extract_about_body(html: str) -> str:
    """Wrapper + header + main + footer (body class styles target .about-body)."""
    m = re.search(
        r"(<header class=\"site-header\"[\s\S]*?</footer>)",
        html,
    )
    if not m:
        raise RuntimeError("Could not parse about.html")
    inner = m.group(1)
    inner = inner.replace("ViviCeramics", "HallowCeramics")
    inner = inner.replace("viviceramics-lang", "hallowceramics-lang")
    inner = '<div class="about-body">\n' + wp_apply_links(inner) + "\n</div>"
    return inner


def cdata_safe(s: str) -> str:
    return s.replace("]]>", "]]]]><![CDATA[>")


def item_xml(
    post_id: int,
    title: str,
    slug: str,
    content_html: str,
    pub_date: str = "Mon, 01 Jan 2024 12:00:00 +0000",
    menu_order: int = 0,
) -> str:
    block_wrap = (
        "<!-- wp:html -->\n"
        '<div class="wp-block-html hallowceramics-import-root">\n'
        f"{content_html}\n"
        "</div>\n"
        "<!-- /wp:html -->"
    )
    encoded = cdata_safe(block_wrap)
    guid = f"https://example.com/?page_id={post_id}"
    return f"""
	<item>
		<title>{xmlu.escape(title)}</title>
		<link>https://example.com/{slug}/</link>
		<pubDate>{pub_date}</pubDate>
		<dc:creator><![CDATA[admin]]></dc:creator>
		<guid isPermaLink="false">{guid}</guid>
		<description></description>
		<content:encoded><![CDATA[{encoded}]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>{post_id}</wp:post_id>
		<wp:post_date>2024-01-01 12:00:00</wp:post_date>
		<wp:post_date_gmt>2024-01-01 12:00:00</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>{xmlu.escape(slug)}</wp:post_name>
		<wp:status>draft</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>{menu_order}</wp:menu_order>
		<wp:post_type>page</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
	</item>
"""


def main() -> None:
    index = (ROOT / "index.html").read_text(encoding="utf-8")
    about = (ROOT / "about.html").read_text(encoding="utf-8")

    home_content = extract_home_body(index)
    about_content = extract_about_body(about)

    # Standalone HTML fragments (paste or PHP include)
    (OUT / "fragment-home-inner.html").write_text(home_content, encoding="utf-8")
    (OUT / "fragment-about-inner.html").write_text(about_content, encoding="utf-8")

    header = """<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.2/"
>
<channel>
	<title>HallowCeramics Static Import</title>
	<link>https://example.com</link>
	<description>Imported pages from viviceramic static site. Replace example.com after import.</description>
	<pubDate>Mon, 01 Jan 2024 12:00:00 +0000</pubDate>
	<language>en-US</language>
	<wp:wxr_version>1.2</wp:wxr_version>
	<wp:base_site_url>https://example.com</wp:base_site_url>
	<wp:base_blog_url>https://example.com</wp:base_blog_url>
	<wp:author>
		<wp:author_id>1</wp:author_id>
		<wp:author_login><![CDATA[admin]]></wp:author_login>
		<wp:author_email><![CDATA[you@example.com]]></wp:author_email>
		<wp:author_display_name><![CDATA[Admin]]></wp:author_display_name>
		<wp:author_first_name><![CDATA[]]></wp:author_first_name>
		<wp:author_last_name><![CDATA[]]></wp:author_last_name>
	</wp:author>
"""

    items = [
        item_xml(10001, "Home (imported layout)", "home-imported", home_content, menu_order=0),
        item_xml(10002, "About (imported layout)", "about-imported", about_content, menu_order=1),
    ]

    footer = """
</channel>
</rss>
"""
    wxr = header + "\n".join(items) + footer
    (OUT / "hallowceramics-wordpress-import.xml").write_text(wxr, encoding="utf-8")
    print("Wrote:", OUT / "hallowceramics-wordpress-import.xml")
    print("Wrote:", OUT / "fragment-home-inner.html")
    print("Wrote:", OUT / "fragment-about-inner.html")


if __name__ == "__main__":
    main()
