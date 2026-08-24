# WP Shuffle Agent Instructions

## Product and business context

This repository contains the premium **Frontend Post Submission Manager (FPSM)** WordPress plugin.

The current product goal is to improve activation, usability, customer trust, and CodeCanyon sales without destabilizing existing installations.

Canonical resources:

- The CEO-approved product tracker is supplied to the agent through the connected Google workspace.
- The canonical design workspace is supplied to the agent through the connected Figma workspace.
- Product page: https://wpshuffle.com/wordpress-plugins/frontend-post-submission-manager/
- CodeCanyon listing: https://codecanyon.net/item/frontend-post-submission-manager/20084181

Do not publish private tracker, design, customer, or analytics URLs in this public repository without explicit approval.

## Operating model

The agent performs both design and development work. Regan Khadgi is the human release approver.

For each assigned work package:

1. Read the CEO-approved task and definition of done from the tracker.
2. Inspect the affected code before proposing a design or implementation.
3. For UI work, create or update an exact frame in the canonical Figma file.
4. Implement only the approved scope on a dedicated feature branch.
5. Test the affected administrator and frontend flows.
6. Open a draft pull request with evidence, known limitations, and rollback notes.
7. Wait for Regan's approval before merging, tagging, publishing, or releasing.

Never perform market research, sales strategy, feature prioritization, or product audits as an implementation task. Those decisions belong to the CEO workflow.

## Repository map

- `frontend-post-submission-manager.php`: plugin bootstrap and version header.
- `includes/classes/`: plugin initialization, admin, AJAX, frontend hooks, notifications, uploads, payments, and shortcodes.
- `includes/views/backend/`: WordPress administrator screens and form-builder views.
- `includes/views/frontend/`: submission forms, dashboard, login, and field templates.
- `assets/css/fpsm-backend-style.css`: administrator UI styles.
- `assets/css/fpsm-frontend-style.css`: public form and dashboard styles.
- `assets/js/fpsm-backend.js`: administrator interactions.
- `assets/js/fpsm-frontend.js`: public interactions.
- `documentation/`: customer documentation.

## Engineering rules

- Preserve backward compatibility with existing forms, options, shortcodes, and stored data.
- Follow WordPress coding and security practices.
- Check capabilities before privileged actions.
- Protect state-changing requests with nonces.
- Sanitize input as early as practical and validate expected shapes.
- Escape output at render time using the correct context.
- Use prepared queries for dynamic SQL.
- Make all user-facing strings translatable with the existing `frontend-post-submission-manager` text domain.
- Do not add activation redirects, telemetry, remote requests, advertising, or third-party dependencies unless explicitly approved.
- Do not rename public hooks, option keys, shortcodes, classes, or template paths without a documented migration.
- Keep changes focused. Avoid unrelated formatting or large mechanical rewrites.
- Never commit credentials, customer data, license keys, build archives, or generated vendor directories.

## Design rules

- Inspect existing FPSM admin styles and components before creating new UI.
- Use WordPress administrator conventions where they improve familiarity.
- Design desktop and responsive states.
- Include empty, loading, success, error, disabled, and dismissed states when relevant.
- Use verified product claims only.
- Record the exact Figma frame or component in the private tracker. Add it to a public pull request only when the design file is approved for public disclosure.
- Match the implementation to the Figma reference while preferring existing repository patterns over a parallel design system.

## Branch and pull-request policy

- Branch from `master`.
- Use `feature/<short-name>`, `fix/<short-name>`, or `agent/<short-name>`.
- Never commit directly to `master`.
- Keep one work package per pull request.
- Open agent pull requests as drafts.
- Do not enable auto-merge.
- Do not merge, tag, bump the release version, upload to CodeCanyon, deploy, or publish without explicit human approval.

## Required validation

Run the checks available for the changed scope and report the exact result in the pull request:

```bash
find . -type f -name '*.php' -not -path './vendor/*' -print0 | xargs -0 -n1 php -l
```

For PHP changes, also verify:

- no PHP warnings/notices with `WP_DEBUG` enabled;
- administrator and non-administrator capability behavior;
- nonce rejection for invalid requests;
- escaped output and sanitized input;
- existing saved forms continue to load and submit.

For UI changes, verify:

- current supported desktop width;
- mobile layout at approximately 375px;
- keyboard access and visible focus;
- no browser console errors;
- no layout regression in existing admin screens or frontend forms.

If a test environment or automated suite is unavailable, say so in the pull request and provide a precise manual smoke-test checklist. Never claim a check passed when it was not run.

## Current priority

The first approved feature is the FPSM **Quick Start onboarding panel**. It should guide a new administrator through:

1. Create Form
2. Add Fields
3. Publish Shortcode
4. Test Submission

Show it only on FPSM administrator screens when no FPSM form exists. Provide an **Add New Form** primary action, documentation/demo links, and a per-user dismiss action. The implementation must use capability and nonce checks, must not redirect on activation, and must not change existing form data.
