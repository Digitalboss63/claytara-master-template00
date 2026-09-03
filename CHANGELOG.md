# Changelog

All significant Claytara Digital website/theme changes should be recorded here.

## Unreleased

### Infrastructure / Agent Access
- Established `Digitalboss63/claytara-master-template00` as the authoritative Claytara website theme repository.
- Added `AGENTS.md` with WordPress/PHP, media, accessibility, debugging, QA, security, and release rules.
- Added `CLAUDE.md` so Claude reads the shared repository protocol.
- Added `.github/copilot-instructions.md` so GitHub coding agents use the same protocol.
- Added `README.md` documenting source-of-truth and current repair priorities.

### Media / Responsive Images — v1.3.1
- Added a dedicated media repair stylesheet that removes forced image heights and prevents stretched or overflowing content media.
- Added separate responsive presentation rules for product/interface artwork and people/team photography.
- Removed the old tall homepage hero behavior at tablet/mobile widths through a compatibility override.
- Synced the newer header/navigation from the current Claytara working theme and added the skip link already present in that version.
- Prepared optimized AVIF versions of the homepage hero and strategy-room imagery for the markup optimization pass.
- Bumped the theme version to `1.3.1`.

### Repair scope queued
- Finish replacing heavyweight homepage image sources with optimized responsive assets and correct intrinsic dimensions.
- Verify mobile/tablet/desktop presentation.
- Verify navigation, forms, appearance settings, Site Integrations/ADA behavior, and PHP/browser-console health.
