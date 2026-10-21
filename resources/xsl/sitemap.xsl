<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:s="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>

    <xsl:template match="/">
        <html lang="ar" dir="rtl">
            <head>
                <meta charset="UTF-8"/>
                <title>Sitemap</title>
                <style>
                    body { margin: 0; background: #f5f2ec; color: #1c3338; font: 16px/1.6 "Segoe UI", Tahoma, sans-serif; }
                    main { max-width: 960px; margin: 0 auto; padding: 2rem 1.25rem 3rem; }
                    h1 { margin: 0 0 0.4rem; font-size: 1.6rem; }
                    p { margin: 0 0 1.25rem; color: #3d555b; }
                    table { width: 100%; border-collapse: collapse; background: #fff; }
                    th, td { padding: 0.7rem 0.85rem; text-align: right; border-bottom: 1px solid #ebe4d6; vertical-align: top; }
                    th { background: #14343c; color: #f5f2ec; font-weight: 600; }
                    a { color: #1f6f7c; text-decoration: none; word-break: break-all; }
                    a:hover { text-decoration: underline; }
                    .meta { white-space: nowrap; color: #3d555b; }
                </style>
            </head>
            <body>
                <main>
                    <h1>Sitemap</h1>
                    <p>ملف XML لمحركات البحث. عدد الروابط: <xsl:value-of select="count(s:urlset/s:url)"/>.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>الرابط</th>
                                <th>آخر تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:for-each select="s:urlset/s:url">
                                <tr>
                                    <td><a href="{s:loc}"><xsl:value-of select="s:loc"/></a></td>
                                    <td class="meta"><xsl:value-of select="s:lastmod"/></td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </main>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
