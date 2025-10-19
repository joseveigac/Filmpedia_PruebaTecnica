<?php get_header(); ?>

<?php
// Slug de la película dentro del CPT "peliculas"
$hero_slug = 'amb-amor-simon';
$hero = get_page_by_path($hero_slug, OBJECT, 'pelicula');
$hero_id = $hero ? $hero->ID : null;

if ($hero) {
  $hero_titol = get_field('titol', $hero); // Text
  $hero_img = get_field('imatge', $hero); // URL
  $hero_edat = get_field('edat', $hero); // Integer
  $hero_tags = get_field('etiquetes', $hero); // Text
  $hero_desc = get_field('descripcio', $hero); // TextArea
  $hero_ludic = get_field('valor_ludic', $hero); // Range
  $hero_cultural = get_field('valor_cultural', $hero); // Range
  $hero_educatiu = get_field('valor_educatiu', $hero); // Range
  $hero_artistic = get_field('valor_artistic', $hero); // Range
  $hero_temes = get_field('temes', $hero); // Text
  
}


$ordered_ids = array_values(array_filter([
  ( get_page_by_path('tot-alhora-a-tot-arreu', OBJECT, 'pelicula')->ID ?? null ),
  ( get_page_by_path('tothom-parla-de-jamie', OBJECT, 'pelicula')->ID ?? null ),
])); 

$peliculas_query = new WP_Query([
  'post_type'      => 'pelicula',
  'posts_per_page' => -1,
  'post__not_in'   => [$hero_id],
  'post__in'       => $ordered_ids,      // orden manual
  'orderby'        => 'post__in',
]);
?>

<header class="w-full mx-auto px-4 mt-4">
    
    <!-- Title + Horizontal Line -->
    <div class="flex items-center gap-2 text-sm font-semibold border-b border-black pb-1 relative">
      <span class="h-2 w-2 bg-highlight"></span>
      <span>Recomanacions</span>

      <!-- Underline -->
      <span class="absolute left-0 bottom-0 h-[2px] w-32 bg-black"></span>
    </div>

    <!-- Subtitle -->
    <h2 class="mt-2 text-lg italic font-normal ">
      Films que et recomanem per a tractar el tema
    </h2>
  </header>

  <main class="pt-8 pb-4">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto px-4">

          <!--#region Hero Movie -->
          <article class="relative overflow-hidden rounded-xl shadow-sm col-span-1 md:col-span-2">
            <img src="<?php echo esc_url($hero_img); ?>"
                alt="<?php echo esc_attr($hero_titol); ?>"
                class="w-full h-[380px] md:h-[440px] object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black via-30% to-transparent to-70%"></div>

            <div class="absolute inset-0 p-4 md:p-6 text-white flex items-start">
              <div>
                <span
                  class="inline-block text-[10px] uppercase bg-highlight px-2 py-1 rounded "
                  >Recomanació</span
                >
                <span
                  class="absolute p-6 right-6 text-[12px] bg-white text-black font-bold px-2 py-1 rounded"
                  ><?php echo esc_html($hero_edat); ?>+ anys
                </span>
                <h3 class="mt-2 text-3xl md:text-4xl font-semibold max-w-[18ch] md:max-w-[12ch]">
                  <?php echo esc_html($hero_titol); ?>
                </h3>
                <p class="mt-2 text-xs md:text-sm font-medium text-white/85 max-w-[260px] md:max-w-[12rem]">
                  <?php echo esc_html($hero_tags); ?>
                </p>
                <p class="mt-4 max-w-[500px] text-[12px] md:text-[15px] text-white/80">
                  <?= wp_kses_post($hero_desc); ?>
                </p>

                <div class="mt-3 inline-grid grid-cols-[max-content_max-content] gap-6 md:gap-12">
                <!-- Columna izquierda: VALORACIÓ -->
                <div>
                  <div class="flex items-center gap-x-2 md:gap-x-6">
                    <p class="text-xs uppercase font-bold text-white/70">Valoració</p>
                    <span class="inline-flex h-5 w-5 items-center justify-center rounded bg-gray-300 text-black text-[14px] font-medium">
                      ?
                    </span>
                  </div>

                  <dl class="mt-2 space-y-1 text-sm">
                    <!-- Lúdic -->
                    <div class="flex items-center gap-3">
                      <dt class="w-12 md:w-20 shrink-0 text-white/85">Lúdic</dt>
                      <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                        <div class="h-full bg-highlight" style="width: <?= (int)$hero_ludic ?>%;"></div>
                      </dd>
                    </div>
                    <!-- Cultural -->
                    <div class="flex items-center gap-3">
                      <dt class="w-12 md:w-20 shrink-0 text-white/85">Cultural</dt>
                      <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                        <div class="h-full bg-highlight" style="width: <?= (int)$hero_cultural ?>%;"></div>
                      </dd>
                    </div>
                    <!-- Educatiu -->
                    <div class="flex items-center gap-3">
                      <dt class="w-12 md:w-20 shrink-0 text-white/85">Educatiu</dt>
                      <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                        <div class="h-full bg-highlight" style="width: <?= (int)$hero_educatiu ?>%;"></div>
                      </dd>
                    </div>
                    <!-- Artístic -->
                    <div class="flex items-center gap-3">
                      <dt class="w-12 md:w-20 shrink-0 text-white/85">Artístic</dt>
                      <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                        <div class="h-full bg-highlight" style="width: <?= (int)$hero_artistic ?>%;"></div>
                      </dd>
                    </div>
                  </dl>
                </div>

                <!-- Columna derecha: ÀMBITS -->
                <div>
                  <p class="text-xs uppercase font-bold text-white/70">Àmbits</p>

                  <?php
                    // 1) obtener temes del ACF
                    $hero_temes_raw = get_field('temes', $hero_id);

                    // 2) dividir por comas y limpiar
                    $hero_temes = array_map(fn($s)=>trim($s," \t\n\r\0\x0B\"'"), preg_split('/,(?=(?:[^"]*"[^"]*")*[^"]*$)/', (string)$hero_temes_raw));


                    // 3) dividir en 2 columnas equilibradas
                    $half = ceil(count($hero_temes) / 2);
                    $col_left  = array_slice($hero_temes, 0, $half);
                    $col_right = array_slice($hero_temes, $half);
                  ?>

                  <?php if (!empty($hero_temes)): ?>
                    <div class="mt-1 md:mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-2 text-xs md:text-sm text-white/90">
                      <ul class="space-y-1">
                        <?php foreach ($col_left as $t): ?>
                          <li><?= esc_html($t) ?></li>
                        <?php endforeach; ?>
                      </ul>
                      <ul class="space-y-1">
                        <?php foreach ($col_right as $t): ?>
                          <li><?= esc_html($t) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </article>
          <!--#endregion -->

          <!--#region Movies-->
          <?php if ( $peliculas_query->have_posts() ) : ?>
            <?php while ( $peliculas_query->have_posts() ) : $peliculas_query->the_post(); 
              // Campos ACF por película
              $titol      = get_field('titol');            // Text
              $img        = get_field('imatge');           // URL
              $edat       = get_field('edat');             // Integer
              $etiquetes   = get_field('etiquetes');        // Text (ej: "#arte #xina")
              $desc       = get_field('descripcio');       // TextArea
              $ludic      = (int) get_field('valor_ludic');     // 0–100
              $cultural   = (int) get_field('valor_cultural');  // 0–100
              $educatiu   = (int) get_field('valor_educatiu');  // 0–100
              $artistic   = (int) get_field('valor_artistic');  // 0–100
              $temes_raw  = get_field('temes');            // Text, separados por comas

              // Temes a lista
              $temes_list = array_filter(array_map(fn($s)=>trim($s," \t\n\r\0\x0B\"'"), preg_split('/,(?=(?:[^"]*"[^"]*")*[^"]*$)/', (string)$temes_raw)));
            ?>
              <article class="relative overflow-hidden rounded-xl shadow-sm col-span-1 group">
                <div class="group-hover:brightness-50 transition-all duration-300 ease-in-out">
                  <img
                    src="<?php echo esc_url($img); ?>"
                    alt="<?php echo esc_attr($titol); ?>"
                    class="w-full h-[380px] md:h-[440px] object-cover"
                  />

                  <!-- Default Content -->
                  <div class="absolute inset-0 p-6 text-white flex items-start">
                    <div class="min-w-0">
                      <span
                        class="inline-block text-[10px] uppercase tracking-wide bg-highlight px-2 py-1 rounded 
                        group-hover:opacity-0 transition-opacity duration-300"
                      >Recomanació</span>

                      <span
                        class="absolute p-6 right-6 text-[12px] bg-white text-black font-bold px-2 py-1 rounded
                        group-hover:opacity-0 transition-opacity duration-300"
                      ><?php echo esc_html($edat); ?>+ anys</span>

                      <h3 class="mt-2 text-3xl md:text-4xl font-semibold max-w-[10ch] pt-4
                        group-hover:opacity-0 transition-opacity duration-300">
                        <?php echo esc_html($titol); ?>
                      </h3>

                      <p class="mt-2 text-xs md:text-sm font-medium text-white/85 max-w-[260px] md:max-w-[10rem]
                      group-hover:opacity-0 transition-opacity duration-300">
                        <?php echo esc_html($etiquetes); ?>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Hover Content -->
                <div class="absolute inset-0 p-6 text-white flex flex-col justify-end items-center">
                  <?php if ($desc) : ?>
                    <p class="mt-0 md:mt-2 max-w-[520px] text-[13px] md:text-[15px] text-white/85 text-left mx-auto opacity-0
                      group-hover:opacity-100 transition-opacity duration-300">
                      <?= wp_kses_post($desc); ?>
                    </p>
                  <?php endif; ?>

                  <div class="mt-8 grid w-full max-w-[640px] grid-cols-2 gap-x-8 md:gap-x-12
                    opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                    <!-- Columna izquierda: VALORACIÓ -->
                    <div>
                      <div class="flex items-center gap-x-2 md:gap-x-6">
                        <p class="text-xs uppercase font-medium text-white/80">Valoració</p>
                      </div>

                      <dl class="mt-2 text-sm">
                        <!-- Lúdic -->
                        <div class="flex items-center gap-3">
                          <dt class="w-12 md:w-20 shrink-0 text-white/85">Lúdic</dt>
                          <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                            <div class="h-full bg-highlight" style="width: <?php echo max(0, min(100, $ludic)); ?>%;"></div>
                          </dd>
                        </div>
                        <!-- Cultural -->
                        <div class="flex items-center gap-3">
                          <dt class="w-12 md:w-20 shrink-0 text-white/85">Cultural</dt>
                          <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                            <div class="h-full bg-highlight" style="width: <?php echo max(0, min(100, $cultural)); ?>%;"></div>
                          </dd>
                        </div>
                        <!-- Educatiu -->
                        <div class="flex items-center gap-3">
                          <dt class="w-12 md:w-20 shrink-0 text-white/85">Educatiu</dt>
                          <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                            <div class="h-full bg-highlight" style="width: <?php echo max(0, min(100, $educatiu)); ?>%;"></div>
                          </dd>
                        </div>
                        <!-- Artístic -->
                        <div class="flex items-center gap-3">
                          <dt class="w-12 md:w-20 shrink-0 text-white/85">Artístic</dt>
                          <dd class="w-16 md:w-24 h-1.5 rounded-full bg-white overflow-hidden">
                            <div class="h-full bg-highlight" style="width: <?php echo max(0, min(100, $artistic)); ?>%;"></div>
                          </dd>
                        </div>
                      </dl>
                    </div>

                    <!-- Columna derecha: TEMES -->
                    <div>
                      <p class="text-xs uppercase font-medium text-white/80">Temes</p>

                      <?php if ( !empty($temes_list) ): ?>
                        <ul class="mt-2 text-sm text-white/90 max-w-[500px] leading-relaxed">
                          <?php foreach ($temes_list as $tema): ?>
                            <li><?php echo esc_html($tema); ?></li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </div>

                  </div>
                </div>
              </article>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php endif; ?>

          <!--#endregion -->
        </section>
  </main>

<?php 
// Footer not required on this static singlepage
// get_footer(); 
?>