# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

CTOs, directores de agencias B2B y empresas que buscan un partner técnico especializado en desarrollo WordPress de alto rendimiento, orquestación de LLMs/IA y automatizaciones de procesos de negocio.

## Product Purpose

Portafolio y plataforma de servicios de César Luis (cesarluis.com). Servir como canal principal para captar clientes B2B, transmitir autoridad técnica y mostrar casos de éxito y proyectos en desarrollo web y automatización con IA.

## Positioning

Partner técnico B2B que transforma procesos de negocio mediante desarrollo WordPress de alto rendimiento y arquitectura web para agentes/LLMs, alejándose del "implementador de temas" genérico.

## Operating Context

Entorno WordPress dinámico nativo (`WP_Query`, CPTs `proyecto` y `servicio`, campos ACF con fallbacks). Renderizado stateless mediante `wp_ai_render_component`.

## Capabilities and Constraints

- **Stack**: WordPress + PHP + Tailwind CSS v4.
- **Compatibilidad**: ACF Free (sin repeaters/flexible content, solo campos planos y CPTs).
- **Control**: Componentes renderizados mediante patrón Adapter `wp_ai_render_component($id, $variant, $data)`.
- **Seguridad/Anti-spam**: Sin Google reCAPTCHA (Zero-bloat, honeypot o Turnstile).

## Brand Commitments

- Tono técnico editorial para CTOs y directores de agencias B2B.
- Estética sofisticada y sin cliché "AI-slop" (sin gradientes morados genéricos, sin marquesinas infinitas sin propósito, sin tipografía monótona).

## Evidence on Hand

- CPTs nativos de WordPress para Proyectos y Servicios.
- Artículos y casos de estudio de automatización y orquestación LLM.

## Product Principles

1. **WordPress Dinámico como Fuente de Verdad**: Todo el contenido se nutre de la BBDD nativa de WordPress.
2. **Inmediatez y SEO (Anti-Slop)**: Carga ultrarrápida, contenido visible para bots sin ocultamientos por JS.
3. **Arquitectura Stateless Limpia**: Separación total entre la lógica de datos y la capa de presentación.
