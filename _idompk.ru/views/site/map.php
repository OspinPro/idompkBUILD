<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://idompk.ru/</loc>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://idompk.ru/catalog/vse-kategorii</loc>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://idompk.ru/catalog/proekty-domov</loc>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://idompk.ru/proektirovanie-domov</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://idompk.ru/informaciya-dlya-klienta</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://idompk.ru/articles</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://idompk.ru/contacts</loc>
    <changefreq>weekly</changefreq>
    <priority>0.5</priority>
  </url>
  <?php foreach($urls as $url): ?>
    <url>
      <loc><?= $host . $url[0] ?></loc>
      <changefreq><?= $url[1] ?></changefreq>
      <priority><?= $url[2] ?></priority>
    </url>
  <?php endforeach; ?>
</urlset>