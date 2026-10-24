# FAQ Accordion (Interactivity API)

> An accessible, keyboard-friendly FAQ accordion built with the WordPress **Interactivity API**. It also outputs **FAQPage structured data** so search engines can understand your questions.

![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)
![WordPress 6.5+](https://img.shields.io/badge/WordPress-6.5%2B-21759b)
![CI](https://github.com/YOUR-USERNAME/faq-accordion-interactivity-block/actions/workflows/ci.yml/badge.svg)

**[Try it live in WordPress Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/YOUR-USERNAME/faq-accordion-interactivity-block/main/blueprint.json)** (no install needed)

<!-- Add a short GIF of the block in action: ![Demo](assets/demo.gif) -->

## Why this exists

FAQ sections are on almost every business site, and they are often built with heavy plugins or inaccessible markup. This block shows the modern, core-supported way to add front-end interactivity to WordPress, with SEO and accessibility built in.

## Features

- Accessible markup: real `<button>` triggers, `aria-expanded`, `aria-controls` and labelled regions
- Keyboard support: Enter/Space to toggle, Arrow Up/Down, Home and End to move between questions
- Single-open or multi-open mode
- Optional **FAQPage JSON-LD** schema for rich search results
- Reorder, add and remove questions in the editor
- Built on the Interactivity API (`data-wp-*` directives), no custom event wiring or jQuery

## Quick start

### Option A: install the plugin

1. Download this repository as a ZIP (**Code → Download ZIP**).
2. In WordPress go to **Plugins → Add New → Upload Plugin**, upload the ZIP and activate it.
3. Edit a page and add the **FAQ Accordion** block.

The compiled `build/` folder is included, so no build step is needed.

### Option B: build from source

```bash
git clone https://github.com/YOUR-USERNAME/faq-accordion-interactivity-block.git
cd faq-accordion-interactivity-block
npm install
npm run build     # uses --experimental-modules for the view script module
```

Requires Node 18+ and **WordPress 6.5+** (the Interactivity API helpers used here arrived in 6.5).

## Block settings

| Attribute | Type | Default | Description |
|---|---|---|---|
| `items` | array | 3 samples | Each item has `question` and `answer` (plain text) |
| `allowMultiple` | boolean | `false` | Allow several answers open at once |
| `addSchema` | boolean | `true` | Output FAQPage JSON-LD |

## How the Interactivity API is used

```php
// render.php: server prints the initial state and the directives
<div data-wp-interactive="showcase/faq" data-wp-context='{"isOpen":false,...}'>
  <button data-wp-on--click="actions.toggle"
          data-wp-bind--aria-expanded="context.isOpen">…</button>
  <div data-wp-bind--hidden="!context.isOpen">…</div>
</div>
```

```js
// view.js: the store holds the behaviour
store( 'showcase/faq', {
  actions:   { toggle() {…}, onKeydown( event ) {…} },
  callbacks: { syncSingle() {…} }, // closes siblings in single-open mode
} );
```

## Project structure

```
src/
├── block.json    Declares "interactivity": true and the viewScriptModule
├── index.js      Registers the block (dynamic, no save)
├── edit.js       Editor UI
├── render.php    Server-rendered markup, directives and JSON-LD
├── view.js       Interactivity store (actions + callbacks)
├── style.scss    Styles (CSS-only plus/minus icon)
└── editor.scss   Editor-only styles
faq-accordion-block.php   Plugin bootstrap
```

## Notes

- Answers are plain text, converted to paragraphs with `wpautop()` and filtered with `wp_kses_post()`.
- Answers are hidden by default on the server, so without JavaScript they stay collapsed. The JSON-LD still exposes them to search engines.
- `JSON_HEX_TAG` is used when encoding the schema so content can never break out of the `<script>` tag.

## Development

```bash
npm run lint:js
npm run lint:css
npm start
```

## Roadmap

- [ ] Rich text answers
- [ ] Deep links (`#question`) that open an item on load
- [ ] Open/close animation using CSS grid

## License

[MIT](LICENSE) © Your Name
