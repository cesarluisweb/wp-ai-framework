# Design System

<!-- impeccable:design-schema 1 -->

## Design Intent

Premium Dark B2B editorial visual language for César Luis (cesarluis.com). Designed for CTOs and agency directors. Replaces generic "AI slop" tells with editorial precision, distinct technical typography, and restrained accent lighting.

## Typography

- **Primary / Display Font**: `Albert Sans` (sans-serif)
- **Mono / Technical Font**: `JetBrains Mono` (monospace)
- **Scale**:
  - Hero Headline: `text-[clamp(2.75rem,12vw,4.8rem)]` / `text-4xl md:text-5xl lg:text-6xl`
  - Section Title: `text-3xl md:text-4xl lg:text-5xl`
  - Card Title: `text-2xl`
  - Body: `text-base` / `text-lg` (max-width `65ch`)
  - Sub-labels / Mono: `text-xs` / `text-sm`

## Colors & Surfaces

- **Theme**: Dark mode only (`#030712` / `bg-gray-950`)
- **Brand Accents**:
  - `--color-brand-300`: `#00D8FF` (Cyan light accent)
  - `--color-brand-400`: `#00A9CC` (Cyan primary CTA)
  - `--color-brand-500`: `#287799` (Deep teal border/shadows)
  - `--color-brand-600`: `#1d5a75`
  - `--color-brand-700`: `#144257`
  - `--color-brand-900`: `#0a1f2a`
  - `--color-brand-950`: `#061219`
- **Surfaces & Cards**: `bg-gray-900/40` (`backdrop-blur-sm`), `border-gray-800/60`

## Corner Radii

- **Cards**: `rounded-2xl` (16px)
- **Buttons / Inputs**: `rounded-lg` (8px)
- **Icon Containers**: `rounded-xl` (12px)
- **Pills / Badges**: `rounded-full` (9999px)

## Layout & Rhythm

- **Max Container Width**: `w-full max-w-[1400px] mx-auto px-6 lg:px-8`
- **Navigation Height Cap**: `80px` max desktop (default `64px-72px`)
- **Eyebrow Constraint**: Max 1 kicker label per 3 sections
- **Hero Viewport**: `min-h-[100dvh]` or `lg:min-h-screen`

## Anti-Patterns & Bans

- ❌ Inter font as primary (replaced by Albert Sans)
- ❌ Thick colored side-tab borders on cards (`border-left: 4px solid`)
- ❌ Icon tiles stacked directly above headings in generic 3-card grids
- ❌ Purple AI gradients / radial glows
- ❌ Auto-scrolling marquees without purposeful content
