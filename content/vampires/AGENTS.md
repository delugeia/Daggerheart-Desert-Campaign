# Vampire campaign content instructions

This directory contains authoritative editable HTML fragments for the related vampire campaign within the unified Daggerheart website. Also read `D:/Sites/campaign/AGENTS.md`. The user's latest decisions and clarified session discussions govern this campaign; compatible earlier biographies fill gaps. Shared setting lore comes from the Daggerheart campaign, but differences between the campaigns must remain distinct.

## Locations and formats

- Edit current vampire prose directly in this directory: `index.html`, `gallery.html`, and `<house>.html`. The house-panel bar lives directly in index.html; the redundant standalone sigil-bar page has been removed.
- Shared layout and navigation live in `D:/Sites/campaign/includes/`; shared CSS/JS in `D:/Sites/campaign/public/css/` and `public/js/`. Never put global wrappers, CSS, scripts, or navigation in content fragments.
- Vampire images live in `D:/Sites/campaign/public/image/vampire/<house>/`. HTML image URLs use `/image/vampire/<house>/<filename>`. Page links use clean paths such as `/vampires/vael`, `/vampires`, and `/vampires/gallery`. PHP maps each URL directly to content/<path>.html; new content files do not need route registration. Navigation metadata is optional. Keep fragment-only links for anchors on the same page. The shared URL helper supports an optional deployment base path.
- Supporting prompts, original/corrected sessions, and historical `website-markdown/` remain under `C:/Users/delug/Documents/ChatGPT/DH Campaign Online/`. That Markdown archive is NOT authoritative; do not regenerate or overwrite current HTML from it. Preserve original audio and verbatim transcripts.
- New maintenance scripts and work records belong in `D:/Sites/campaign/work/`, outside public/. Older working records in the supporting campaign folder are historical.
- The former website/ and standalone D:/Sites/campaign/vampires/ sites are retired. Do not recreate them or the former public/vampires junction. The old public/vampires redirect pages have also been removed; do not recreate compatibility files or old URL handling.

## Canon and presentation

Use house/houses for the factions, and do not present the documented roster as exhaustive or fixed in size. The six-column sigil layout is a presentation choice. Call the agreement the Compact without a numbered qualifier.

Voss was renamed Koss and Velrath was renamed Belrath on November 1, 2026. These are the same houses and individuals, not new ones. Use Koss/Belrath in current names, surnames, paths, and prompts; interpret preserved originals using that map. Do not alter original recordings/verbatim transcripts or read-only shared sources.

Gideon Flint, Professor Ambrose Quill, and Faris Reed are vampires; superseded mortal wording in historical material does not override that decision. Brother Osric Bell is Nadia Bell's father; Nadia is his eldest daughter. Both remain mortal. Edmund Graves is a vampire; Grim Nackle is his unsuspecting mortal descendant. Malrec Koss is the publicly recognized sole Koss leader; Hester Pike's actual leadership remains in the detail and her nature is unspecified.

Preserve established facts, beliefs, rumors, optional hooks, allegations, and unresolved questions as distinct. Do not resolve ambiguity or turn proposals into canon for formatting convenience. These pages are shared with all players: NPC and house secrets are in-world secrets, not information withheld from players. Avoid GM-only labels, player spoiler warnings, source-priority/process notes, or revision boilerplate in published prose.

## House and gallery layouts

Use one '[House] Members' section combining biography and appearance. Headings presume vampires; append '(mortal)' after established mortal names, and omit species from roles. Start appearance paragraphs with the familiar name followed by 'is'. Keep each square thumbnail in a dedicated right column, aligned with its heading and the masthead sigil; reserve that column throughout the entry and never flow text under the image. Link the thumbnail to the full individual portrait using the shared lightbox. Other house prose uses the full available content width.

Each house has outgoing and incoming views. Incoming views redundantly reproduce the corresponding outgoing views from other houses; keep both synchronized, preserve directional differences, and show incoming house names as plain bold text without hyperlinks.

House pages end with a full-width household image and ordered caption. Do not add a Visual references title or separate head portrait there. Gallery sections show first-name individual thumbnails in household order, bolding the designated head, followed by the sigil, with lightbox links to full images. A full-width household image and left-to-right caption follow, without a household title. Do not restore separate full head portraits/sigil panels in the gallery.

## Image provenance and naming

Save the complete image prompt BEFORE generation in the flat `C:/Users/delug/Documents/ChatGPT/DH Campaign Online/image-prompt/` folder. Prompt basenames always match image basenames, with `.prompt.md`. Preserve prompts and original versions as provenance. Follow the user's visible Assistant/sub-agent image workflow unless changed; consult current art style and character references before generating. Written canon overrides accidental image discrepancies.

Household images use `<house>_portrait.png`, sigils `<house>_sigil.png`. Individual images use `<house>-<first>-<last>.png`, with `-thumbnail.png` for square bust thumbnails. Repeat surnames even when they match the house; omit titles, nicknames, and the word portrait. Osric uses harrow-osric-bell. Preserve archived -old assets and matching prompts. Update references when files move or are renamed.

## Coordination

Vampire Manager may assign work to the visible Assistant project chat and relay applicable user approvals. Inter-agent communication must be visible. Questions for the user go through Vampire Manager; coordinate file ownership before concurrent edits. Do not use the retired chat-local Assistant subagent.
