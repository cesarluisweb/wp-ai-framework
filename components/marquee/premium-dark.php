<?php
/**
 * Marquee Component - Premium Dark
 * 
 * Expected $data array:
 * - 'items' => array of elements with 'name' and 'icon'
 */

$items = isset($data['items']) ? $data['items'] : [];

if (empty($items)) return;

// Duplicamos los elementos solo una vez para mantener el scroll infinito continuo pero reducir el tamaño del DOM
$marquee_items = array_merge($items, $items);
?>
<section class="w-full relative py-8 bg-gray-950 overflow-hidden border-y border-gray-900/50">
    <!-- Gradiente de máscara para desvanecer los bordes izquierdo y derecho -->
    <div class="absolute inset-0 z-10 pointer-events-none" style="background: linear-gradient(to right, #061219 0%, transparent 15%, transparent 85%, #061219 100%);"></div>
    
    <div class="flex animate-marquee w-max">
        <?php foreach ($marquee_items as $tech) : ?>
            <div class="flex items-center gap-4 px-10 group cursor-default">
                <?php if ($tech['icon'] === 'learndash') : ?>
                    <svg class="h-8 w-8 text-gray-500 group-hover:text-white transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                <?php elseif ($tech['icon'] === 'cloud') : ?>
                    <svg class="h-8 w-8 text-gray-500 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                    </svg>
                <?php elseif ($tech['icon'] === 'antigravity') : ?>
                    <svg class="h-8 w-8 text-gray-500 group-hover:text-brand-300 transition-colors duration-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0L7 10m5-5l5 5" />
                        <ellipse cx="12" cy="15" rx="6" ry="2" stroke="currentColor" />
                    </svg>
                <?php else : ?>
                    <img src="https://cdn.simpleicons.org/<?php echo $tech['icon']; ?>/ffffff" alt="<?php echo $tech['name']; ?>" class="h-8 w-auto object-contain max-w-[32px] opacity-40 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all duration-500" width="32" height="32" />
                <?php endif; ?>
                <span class="text-gray-500 font-semibold text-xl tracking-wide group-hover:text-white transition-colors duration-500 whitespace-nowrap"><?php echo $tech['name']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>
