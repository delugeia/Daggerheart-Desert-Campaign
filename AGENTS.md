# AGENTS.md

## Purpose

This project contains the **Daggerheart Desert Campaign**, a mythic desert-fantasy campaign drawing heavily from Egyptian culture, religion, and mythology. It also serves as a framework for related campaigns that may branch from the same setting.

Use the project sources to preserve continuity, established lore, tone, and terminology without loading unnecessary material into context.

## Sites, environments, and deployment

| Item | Details |
|---|---|
| Local development site | [https://campaign.test/](https://campaign.test/) |
| Local environment | Herd / Nginx |
| Production site | [https://campaign.delugeia.com/](https://campaign.delugeia.com/) |
| Production environment | Forge / Ubuntu / Nginx |
| GitHub repository | [delugeia/Daggerheart-Desert-Campaign](https://github.com/delugeia/Daggerheart-Desert-Campaign) |
| GitHub profile | `delugeia` |

Production is deployed automatically through the GitHub→Forge deploy hook. Pushing to the deployment branch triggers a production deployment.

## Source of Truth

Treat campaign material as canon unless a later conversation or source explicitly overrides it.

Use this priority order:

1. **The user's latest explicit decisions or corrections.**
2. **The current HTML campaign encyclopedia in `content/encyclopedia/`, with its entry point at `content/home.html`,** for current organized canon. Converted Markdown originals have been removed; maintain current content directly in HTML.
3. **Original project conversations, transcripts, notes, and source documents** when more detail is needed or the encyclopedia is ambiguous.
4. **Official Daggerheart material** for rules, ancestries, adversaries, and mechanical verification. It is reference material, not campaign lore.
5. **General knowledge or web research** only when requested or genuinely necessary. Clearly distinguish it from campaign-derived information.

Later material overrides earlier material when they conflict. Do not silently merge incompatible versions.

If a change is notable or useful to preserve historically, identify it in a **GM Note** rather than treating both versions as simultaneously true.

## Using the Campaign Encyclopedia

Do **not** read or digest the entire encyclopedia at the start of a conversation.

Instead:

- Begin with `content/home.html` when you need to locate current campaign information.
- Open only the topic files relevant to the current task.
- Use `content/encyclopedia/appendix-names.html` for quick identification or disambiguation of campaign-specific names.
- Consult more than one topic file when a subject naturally crosses categories.
- Return to original notes or transcripts only when the encyclopedia lacks needed detail or a conflict must be resolved.

Broad audits, full campaign summaries, continuity reviews, or encyclopedia updates may justify reading many or all topic files.

## Canon and Uncertainty

Preserve the distinction between fact, belief, rumor, possibility, and GM planning.

Examples:

- If the campaign says people **believe** Amun is imprisoned, state that it is believed.
- If an NPC suspects something, do not convert the suspicion into fact.
- If an idea was brainstormed but never adopted, treat it as a proposal rather than established canon.
- If the user adopts an idea during conversation, it becomes canon unless they say otherwise.

Do not fill gaps with generic fantasy lore simply because it would be plausible.

When inventing new material, make it fit existing canon but do not present it as previously established.

## Campaign Tone and Design

The campaign's established tone is generally:

- Mythic desert fantasy.
- Ancient, sacred, oppressive, and weathered.
- Egyptian-inspired without requiring strict historical simulation.
- Religious and political intrigue involving active gods and competing truths.
- Exploration of ruins, tombs, temples, mines, deserts, and forgotten places.
- Mysteries involving identity, memory, death, rebirth, justice, and the nature of divinity.
- Dangerous but grounded creatures, undead, djinn, cults, factions, and lost magic.

Favor interconnected material. New NPCs, locations, artifacts, adversaries, and adventures should connect naturally to existing characters, factions, mysteries, or geography when appropriate.

Avoid making every mystery part of one master conspiracy unless the campaign supports that connection.

## Player Characters

Use player names only to identify who plays a character.

Do not include or rely on personal information about the players, their personalities, play styles, habits, or relationships unless the user explicitly asks for that information in the current conversation.

When developing character material:

- Preserve current ancestry, class, community, patron, history, motivations, and established visual details.
- Tie personal hooks into the campaign when useful.
- Do not resolve a character mystery prematurely unless the user asks to develop its answer.
- Treat earlier character concepts as superseded when later conversations revised them.

## NPCs, Factions, and Lore

Reuse established names and terminology exactly when practical.

Before creating a new NPC, faction, location, artifact, god-related concept, or named creature that might overlap existing material, check the relevant encyclopedia file or `AppendixNames.md`.

Do not rename established material merely to improve it.

For gods and religion, preserve the difference between:

- Public doctrine.
- Heresy.
- Secret knowledge.
- Character belief.
- GM-established truth.

## Daggerheart Mechanics

Use official Daggerheart source material as needed to verify rules or provide page references.

When creating custom adversaries, encounters, abilities, items, or mechanics:

- Follow Daggerheart conventions and the appropriate tier.
- Distinguish official rules from campaign-specific or custom mechanics.
- Do not import D&D mechanics merely because earlier campaign history involved D&D.
- Preserve established campaign house rules or custom mechanics when they have been explicitly adopted.

## Images and Visual Design

When creating or modifying campaign imagery, consult the project's art-style file **as needed** rather than loading it preemptively.

The art-style file is authoritative for visual presentation.

Also consult relevant character, creature, location, or visual-asset references before depicting an established subject.

Important behavior:

- If the user asks for an **image prompt**, provide the prompt only.
- If the user asks to **create the image**, generate it.
- Preserve established visual continuity unless the user requests a redesign.
- Treat existing generated images and `VisualAssets.md` as references for continuity, not automatic replacements for written canon.
- Written canon overrides accidental inconsistencies in generated images.

## Brainstorming and New Material

The user often develops material iteratively.

When brainstorming:

- Offer distinct, usable ideas rather than many minor variations of the same idea.
- Treat suggestions as proposals until the user selects or adopts them.
- Build on selected ideas instead of repeatedly restarting from scratch.
- Point out meaningful conflicts with existing canon.
- Prefer campaign-specific names, motives, imagery, and consequences over generic fantasy concepts.

When the user asks to formalize or update campaign material, incorporate adopted ideas into the current canon and clearly note significant revisions.

## Response Preferences

Keep responses direct and useful.

- Start with the answer rather than restating the request.
- Be concise unless the task requires depth.
- State uncertainty clearly.
- Ask clarifying questions when answers would materially affect the result, especially before large worldbuilding or artifact-generation tasks.
- For complex work, organize information with concise headings and bullets.
- Do not over-explain routine steps.

## Unified website — November 2, 2026

The main campaign and vampire reference now share one PHP layout, one navigation list, and the vampire site's parchment, crimson, and serif presentation. Keep the campaigns' canon distinctions intact; merging presentation does not merge conflicting lore. Read `content/vampires/AGENTS.md` before vampire work.

### Authoritative files

- `content/home.html`: encyclopedia table of contents and default Home content.
- `content/encyclopedia/*.html`: current campaign articles, including `appendix-names.html`.
- `content/vampires/index.html`, `gallery.html`, and each `<house>.html`: current vampire content.
- `content/about.html`, `art-style.html`, and `character-sheets.html`: other reference content. Consult `content/art-style.html` for current visual guidance.
- `includes/navigation-config.php`: optional navigation order/groups, labels, titles, layout classes, and content filenames for menu entries. It is NOT a routing allowlist. A new valid HTML content file is accessible automatically without an entry; add an entry only when it should appear in navigation or needs presentation metadata.
- `includes/navigation.php` and `layout.php`: shared sidebar and document structure.
- `public/index.php`: the small controller mapping URL paths directly to content/<path>.html, with / mapped to content/home.html. It reads HTML directly; no Markdown parsing or Composer autoloading occurs at runtime. Missing or invalid paths return HTTP 404. Validate path segments and use realpath containment to serve only HTML files inside content/. Never include PHP or resolve files outside that directory.
- `public/css/styles.css`: the sole shared stylesheet. Reuse existing classes and keep all authored styling here.
- `public/js/site.js`: the main site's mobile Contents menu. `public/js/lightbox.js`: shared image lightbox, wheel zoom, and panning.
- `public/image/`: image root, singular. Organize images by subject; vampire assets belong in `public/image/vampire/<house>/`, and maps in `public/image/maps/`. The headless Anubis statue map is `public/image/maps/anubis-statue-headless-top-down.png`. Preserve descriptive filenames and matching prompt basenames.
- `public/characters/`: directly served character PDFs. Update the PDF and `content/character-sheets.html` when a sheet changes; listing is not generated at request time.

Content pages are editable HTML fragments, NOT complete documents. Keep headings, paragraphs, lists, tables, captions, meaningful section grouping, and useful internal anchors. Do not add doctype, html/head/body, main, repeated global navigation, embedded styles, script includes, or shared document footers to content. The layout provides those once. Content links use site-root URL paths: `/vampires/vael#optional-anchor`, `/encyclopedia/geography`, etc. These map to the matching HTML filenames, not navigation keys. Images use `/image/vampire/<house>/<filename>` and PDFs `/characters/<filename>`. Fragment-only links such as `#vael-members` remain unchanged. The shared site_url() helper prefixes shared assets/navigation and root-relative content attributes with optional CAMPAIGN_BASE_PATH for deployment in a subdirectory; do not add a base tag, which would break fragment-only links. Do not introduce an iframe or a Markdown-to-HTML editing/build requirement.

The shell uses a left sidebar, centered content with a 1200px maximum width, and the former main site's collapsible mobile Contents menu. Preserve vampire house full-width prose, dedicated member image columns, sigil alignment, ordered household captions, gallery thumbnail order and bold heads, and existing lightbox behavior. When changing shared UI, check both encyclopedia and vampire pages and a mobile viewport.

### Historical files

The 20 original Markdown documents converted to HTML were content-verified and removed on November 2, 2026. Current content lives only in content/*.html and its subdirectories. Use content/home.html, content/art-style.html, content/character-sheets.html, and content/encyclopedia/*.html in place of the removed Markdown documents. Do not recreate Markdown duplicates. All AGENTS.md files remain active instructions and are preserved; prompts, session records, and unconverted Markdown are unaffected. League CommonMark stays installed under `vendor/` with composer files unchanged, but is not used by the site.

The former standalone sites and all compatibility redirect files have been removed. The original root vampires/ site and public/vampires junction are retired. Do not recreate duplicate live copies or old URL redirects. Content exists only under content/; public/ contains the PHP controller and browser assets.

All new agent maintenance scripts, migration records, intermediates, and verification reports belong under project-level `work/`. Earlier scripts and the former site wrappers there are historical records, not a build or restore pipeline. Review before reuse. Keep `content/`, `includes/`, `work/`, `_secrets/`, and private support material outside the public document root. Do not publish or deploy externally without a user request.

Vampire prompts and historical session/Markdown material remain in `C:/Users/delug/Documents/ChatGPT/DH Campaign Online/`; consult the vampire instructions for those locations. Do not link to prompt files or Markdown archives from the public website.

## URL paths — November 2, 2026

Public page addresses map directly to editable content: `/vampires/vael` → `content/vampires/vael.html`; `/vampires` → `content/vampires/index.html`; `/vampires/gallery` → `content/vampires/gallery.html`; `/encyclopedia/geography` → `content/encyclopedia/geography.html`. The special default `/` maps to `content/home.html`; `/home` redirects to `/`. Paths have no trailing slash, except `/`. A new HTML file automatically creates its matching URL; navigation metadata is optional and never authorizes file access.

Old query-string page/sheet URLs, standalone HTML URLs, and vampire shell hashes are no longer supported. includes/legacy-urls.php and the public HTML redirect stubs have been removed at the user’s request. Keep current links pointed at clean content paths; do not restore legacy compatibility. Normal canonical redirects for /home and trailing slashes may remain.

Herd already forwards non-file requests to the PHP controller. Production Nginx must serve from public/ and route missing paths to index.php while serving real assets directly. See `work/path-routing/production-nginx.conf.example` for the location fallback; retain the server's existing PHP-FPM handler. No production server configuration was changed by this local migration. For subdirectory deployment configure CAMPAIGN_BASE_PATH and adapt the Nginx fallback. Keep CommonMark installed but unused; maintain converted campaign content directly as HTML.

## Post-merge cleanup — November 2, 2026

The root characters/ directory was removed after verifying its four PDFs were identical to the served copies. public/characters/ is now the only campaign PDF directory. The empty root images/ directory was removed. The map formerly under assets/maps/ was moved unchanged to public/image/maps/anubis-statue-headless-top-down.png; the emptied assets/ containers were removed. Use /image/maps/... in content URLs.

The redundant standalone content/vampires/sigil-bar.html page and its hidden navigation entry were removed. Maintain the house-panel bar directly in content/vampires/index.html; there is no separate bar page to synchronize. Do not recreate these removed duplicate files/folders. League CommonMark, vendor/, composer.json, and composer.lock remain in place and unused by the website.

## Directory index lookup

Routing checks `content/<path>.html` first, then `content/<path>/index.html`. Thus `/vampires` loads `content/vampires/index.html` without a registered route. The root continues to prefer `content/home.html`, falling back to `content/index.html`. Navigation URLs are derived from content filenames; directory index files link to their parent URL without `/index` or `.html`. Existing canonical trailing-slash redirects apply. Path validation and realpath containment apply to both lookup candidates. Missing pages/directories still return 404.

The vampire overview was renamed from overview.html to index.html. Use `/vampires` for its public URL. Do not recreate the old page or add compatibility redirects.
