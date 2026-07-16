<?php
/**
 * Header Component - Premium Dark (Floating Pill)
 * 
 * Expected $data variables:
 * - $site_name (string)
 * - $nav_links (array of arrays: label, url)
 * - $cta_button (array: label, url)
 */

$site_name = $data['site_name'] ?? 'César Luis Amundaray';
$nav_links = $data['nav_links'] ?? [];
$cta_button = $data['cta_button'] ?? null;
?>

<header class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-gray-950/80 backdrop-blur-xl border-b border-gray-800/50" id="main-header">
    <div class="w-full max-w-[1400px] mx-auto px-6 lg:px-8 py-5 flex items-center justify-between">
        
        <!-- Logo / Name -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 text-xl font-black text-white tracking-tight hover:text-brand-300 transition-colors duration-300">
            <!-- Monograma C -->
            <div class="relative w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br from-brand-400/20 to-brand-600/10 border border-brand-500/30">
                <span class="text-brand-300 font-black text-lg leading-none mt-0.5">C</span>
            </div>
            <span>César Luis</span>
        </a>

        <div class="flex items-center gap-2 sm:gap-4 lg:gap-8">
            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:block">
                <ul class="flex items-center gap-8">
                    <?php foreach ($nav_links as $link): 
                        $has_mega = !empty($link['megamenu']);
                        $mega_type = $link['type'] ?? '';
                        if ($mega_type === 'portfolio' || $mega_type === 'blog') {
                            $mega_width = 'w-[720px]';
                            $mega_left = 'left-[calc(50%-360px)]';
                        } else {
                            $mega_width = 'w-[640px]';
                            $mega_left = 'left-[calc(50%-320px)]';
                        }
                    ?>
                    <li class="<?php echo $has_mega ? 'group relative py-6 -my-6' : ''; ?>">
                        <a href="<?php echo esc_url($link['url']); ?>" class="text-sm font-medium text-gray-300 group-hover:text-brand-300 hover:text-brand-300 transition-colors duration-300 flex items-center gap-1">
                            <?php echo esc_html($link['label']); ?>
                            <?php if($has_mega): ?>
                                <svg class="w-4 h-4 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            <?php endif; ?>
                        </a>
                        
                        <?php if ($has_mega): ?>
                            <!-- Megamenu Dropdown -->
                            <div class="absolute top-full <?php echo $mega_left; ?> pt-3 <?php echo $mega_width; ?> opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 mt-2 group-hover:mt-0">
                                <div class="bg-gray-950 border border-gray-800/80 rounded-2xl shadow-2xl p-6 overflow-hidden w-full">
                                    
                                    <?php if ($mega_type === 'services'): ?>
                                        <div class="grid grid-cols-2 gap-4">
                                            <?php foreach($link['megamenu'] as $s_item): ?>
                                                <a href="<?php echo esc_url($s_item['url']); ?>" class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-900/80 border border-transparent hover:border-brand-500/30 transition-all duration-300 group/item relative overflow-hidden">
                                                    <!-- Glow sutil en hover -->
                                                    <div class="absolute inset-0 bg-brand-500/5 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                                    
                                                    <div class="w-10 h-10 rounded-lg bg-gray-900 border border-gray-800 flex items-center justify-center text-brand-400 group-hover/item:text-brand-300 group-hover/item:scale-110 transition-all duration-300 shrink-0 relative z-10">
                                                        <?php 
                                                        $icon_name = $s_item['icon'] ?? 'code';
                                                        echo wp_ai_get_service_icon_svg($icon_name, 'w-5 h-5');
                                                        ?>
                                                    </div>
                                                    <div class="relative z-10">
                                                        <div class="text-white font-bold mb-1 group-hover/item:text-brand-300 transition-colors"><?php echo esc_html($s_item['title']); ?></div>
                                                        <div class="text-xs text-gray-400 line-clamp-2"><?php echo esc_html($s_item['desc']); ?></div>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <div class="col-span-2 mt-2 pt-4 border-t border-gray-800/50 flex justify-center">
                                                <a href="<?php echo esc_url($link['url']); ?>" class="text-brand-400 text-sm font-semibold hover:text-brand-300 flex items-center gap-1 group/btn">
                                                    Ver todos los servicios <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    <?php elseif ($mega_type === 'portfolio' || $mega_type === 'blog'): ?>
                                        <div class="grid grid-cols-2 gap-4">
                                            <?php foreach($link['megamenu'] as $item): ?>
                                                <a href="<?php echo esc_url($item['url']); ?>" class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-900/80 border border-transparent hover:border-brand-500/30 transition-all duration-300 group/item relative overflow-hidden">
                                                    <!-- Glow sutil en hover -->
                                                    <div class="absolute inset-0 bg-gradient-to-br from-brand-400/5 to-transparent opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                                    
                                                    <div class="w-16 h-16 rounded-lg bg-gray-900 border border-gray-800 overflow-hidden shrink-0 relative">
                                                        <?php if(!empty($item['image'])): ?>
                                                            <img src="<?php echo esc_url($item['image']); ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover/item:opacity-100 group-hover/item:scale-110 transition-all duration-500">
                                                        <?php else: ?>
                                                            <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 to-brand-900/20 flex items-center justify-center group-hover/item:scale-110 transition-transform duration-500">
                                                                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="relative z-10 pr-2">
                                                        <h4 class="text-white font-bold text-sm group-hover/item:text-brand-300 transition-colors leading-snug line-clamp-2"><?php echo esc_html($item['title']); ?></h4>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <div class="col-span-2 mt-2 pt-4 border-t border-gray-800/50 flex justify-center">
                                                <a href="<?php echo esc_url($link['url']); ?>" class="text-brand-400 text-sm font-semibold hover:text-brand-300 flex items-center gap-1 group/btn">
                                                    <?php echo ($mega_type === 'portfolio') ? 'Explorar portafolio' : 'Leer todos los artículos'; ?> <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            
            <!-- Global CTA Button -->
            <?php if ($cta_button): ?>
            <div class="lg:pl-8 lg:border-l lg:border-gray-700/50 flex items-center">
                <a href="<?php echo esc_url($cta_button['url']); ?>" class="btn-primary-sm h-10 lg:h-auto flex items-center justify-center !px-3 text-xs sm:text-sm sm:!px-4 lg:!px-6">
                    <?php echo esc_html($cta_button['label']); ?>
                </a>
            </div>
            <?php endif; ?>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden w-10 h-10 rounded-lg bg-gray-900/80 border border-gray-800 flex items-center justify-center text-white hover:text-brand-300 hover:border-brand-500/30 transition-all duration-300 cursor-pointer focus:outline-none group" id="mobile-menu-btn" aria-label="Toggle menu">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

</header>

<!-- Mobile Menu Fullscreen Overlay -->
<div class="fixed inset-0 bg-gray-950/60 backdrop-blur-xl z-[100] hidden opacity-0 transition-opacity duration-500 group/menu" id="mobile-menu">
    <div class="w-full h-full flex flex-col md:flex-row relative">
        
        <!-- Logo Top Left -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="absolute top-6 left-6 lg:top-8 lg:left-8 flex items-center gap-3 text-xl font-black text-white tracking-tight hover:text-brand-300 transition-colors duration-300 z-50">
            <div class="relative w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-brand-400/20 to-brand-600/10 border border-brand-500/30">
                <span class="text-brand-300 font-black text-xl leading-none mt-0.5">C</span>
            </div>
            <span class="md:hidden">César Luis</span>
        </a>
        
        <!-- Left Side (Visual Branding) - Hidden on small screens -->
        <div class="hidden md:flex md:w-1/2 relative border-r border-gray-800/50 items-center justify-center overflow-hidden">
             <!-- Ambient Glow -->
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-[100px]"></div>
             <!-- Large Monogram -->
             <div class="relative z-10 text-[25rem] font-black text-white/5 select-none leading-none">
                 C
             </div>
        </div>
        
        <!-- Right Side (Navigation) -->
        <div class="w-full md:w-1/2 h-full flex flex-col justify-center px-8 sm:px-16 lg:px-24 relative">
            <!-- Close Button -->
            <button class="absolute top-6 right-6 lg:top-8 lg:right-8 w-12 h-12 rounded-lg bg-gray-900/50 border border-gray-800/50 flex items-center justify-center text-white hover:text-brand-300 hover:border-brand-500/30 transition-all duration-300 cursor-pointer group z-50" id="mobile-menu-close">
                <svg class="w-8 h-8 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Navigation Links -->
            <nav class="flex flex-col gap-2 sm:gap-4 items-end text-right mt-12">
                <!-- Manual Home Link for Mobile Menu only -->
                <div class="overflow-hidden py-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="block text-3xl sm:text-5xl lg:text-6xl font-extrabold text-gray-400 hover:text-white tracking-tight mobile-link translate-y-[150%] group-[.menu-open]/menu:translate-y-0 transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
                       style="transition-delay: 0s;">
                        <?php _e('Inicio', 'wp-ai-theme'); ?>
                    </a>
                </div>

                <?php foreach ($nav_links as $index => $link): ?>
                <div class="overflow-hidden py-2">
                    <a href="<?php echo esc_url($link['url']); ?>" 
                       class="block text-3xl sm:text-5xl lg:text-6xl font-extrabold text-gray-400 hover:text-white tracking-tight mobile-link translate-y-[150%] group-[.menu-open]/menu:translate-y-0 transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
                       style="transition-delay: <?php echo ($index + 1) * 0.08; ?>s;">
                        <?php echo esc_html($link['label']); ?>
                    </a>
                </div>
                <?php endforeach; ?>
                
                <?php if ($cta_button): ?>
                <div class="mt-8 overflow-hidden py-2">
                    <a href="<?php echo esc_url($cta_button['url']); ?>" 
                       class="inline-flex items-center gap-2 text-xl sm:text-2xl font-bold text-brand-400 hover:text-brand-300 mobile-link translate-y-[150%] group-[.menu-open]/menu:translate-y-0 transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
                       style="transition-delay: <?php echo count($nav_links) * 0.08; ?>s;">
                        <?php echo esc_html($cta_button['label']); ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <?php endif; ?>
            </nav>
            
            <!-- Footer Info (Social Media Icons) -->
            <?php
            $active_socials = [];
            if (function_exists('wp_ai_get_social_links')) {
                $active_socials = wp_ai_get_social_links();
            }
            ?>

            <?php if (!empty($active_socials)): ?>
            <div class="absolute bottom-8 right-8 sm:right-16 lg:right-24 flex gap-4 text-gray-500 z-50">
                <?php foreach ($active_socials as $key => $social): ?>
                    <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-brand-300 transition-all duration-300 hover:scale-110" aria-label="<?php echo esc_attr($social['platform']); ?>">
                        <?php echo $social['icon']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnOpen = document.getElementById('mobile-menu-btn');
    const btnClose = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');
    const links = document.querySelectorAll('.mobile-link');
    
    function toggleMenu() {
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            setTimeout(() => { 
                menu.classList.remove('opacity-0'); 
                menu.classList.add('menu-open');
            }, 10);
            document.body.style.overflow = 'hidden';
            if (window.lenis) window.lenis.stop();
        } else {
            menu.classList.remove('menu-open');
            menu.classList.add('opacity-0');
            setTimeout(() => { menu.classList.add('hidden'); }, 500);
            document.body.style.overflow = '';
            if (window.lenis) window.lenis.start();
        }
    }
    
    if (btnOpen && btnClose && menu) {
        btnOpen.addEventListener('click', toggleMenu);
        btnClose.addEventListener('click', toggleMenu);
        links.forEach(link => link.addEventListener('click', toggleMenu));
    }
});
</script>
