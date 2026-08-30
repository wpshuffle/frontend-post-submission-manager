# Quick Start onboarding smoke-test matrix

This checklist validates the FPSM Quick Start onboarding panel without changing existing forms, options, shortcodes, hooks, or template paths.

## Automated checks already run

| Check | Environment | Expected result | Recorded result |
| --- | --- | --- | --- |
| PHP syntax lint | PHP 7.4 | All PHP files parse without errors | Passed in GitHub Actions; see draft PR for the latest run |
| PHP syntax lint | PHP 8.3 | All PHP files parse without errors | Passed in GitHub Actions; see draft PR for the latest run |
| Scope/security review | Pull request diff | Capability, nonce, sanitization/escaping, translation, and user-meta isolation are present | Completed; runtime behavior still requires verification |
| Asset scope review | Pull request diff | Urbanist is a local WOFF2 and Quick Start styles load only on FPSM Forms | Completed at commit 57711a8eec1e4887b996c599758be5784b5fcfa8; runtime loading remains covered by QS-11/12 |
| Isolated runtime smoke test | WordPress 7.1 / PHP 8.3, WordPress Playground CLI 3.1.51 | Functional, security, persistence, activation, and rollback behaviors match the matrix | 12 scenarios passed and 3 are partial on 2026-08-28; details below |
| Supported-floor runtime check | WordPress 7.1 / PHP 7.4, WordPress Playground CLI 3.1.51 | Empty-state panel renders without PHP diagnostics | Passed on 2026-08-28 |

## Runtime prerequisites

- A disposable WordPress test site with FPSM installed from this feature branch.
- `WP_DEBUG` and `WP_DEBUG_LOG` enabled.
- One administrator test account and one non-administrator test account.
- Browser developer tools available for console and responsive checks.
- A database snapshot or disposable site so upgrade and rollback checks cannot affect production data.

Record the WordPress version, PHP version, browser, tester, date, and evidence link for every run. Test at minimum the product's supported PHP floor and a current supported PHP version. Do not test on a production site.

## Functional and security matrix

| ID | Scenario and steps | Expected result | Status/evidence |
| --- | --- | --- | --- |
| QS-01 | Fresh install or clean test state; sign in as administrator; open **FPSM → Forms** with no forms. | One four-step Quick Start panel appears immediately below the FPSM page header. Steps read Create Form, Add Fields, Publish Shortcode, and Test Submission. | **Passed** — isolated PHP 8.3 runtime; panel and all four labels present below the header |
| QS-02 | Create and save one form, then return to **FPSM → Forms**. | The standard forms list appears and Quick Start is absent. Existing rows and actions are unchanged. | **Passed** — two activation-seeded forms remained listed and the panel was absent |
| QS-03 | Visit every other FPSM admin screen and unrelated WordPress admin screens. | Quick Start is absent; no layout regression occurs. | **Passed (targeted)** — stylesheet absent on Settings and existing-form edit screens; browser-wide visual regression remains covered by QS-11 |
| QS-04 | With no forms, activate **Add New Form** in the Quick Start panel. | The existing Add New Form route opens once; no activation redirect or extra remote request occurs. | **Passed** — CTA used `admin.php?page=fpsm-add-new-form` and the route returned the existing screen |
| QS-05 | Activate Documentation and Demo links. | Each opens the intended existing public destination. No private tracker or design URL is exposed. | **Passed** — both approved public destinations present; no private URLs in panel markup |
| QS-06 | As an administrator, dismiss the panel with a valid nonce, reload, sign out, and sign in again. | The panel remains hidden for that WordPress user and no form/settings data changes. | **Passed** — valid dismissal persisted after a new login |
| QS-07 | Repeat QS-01 using a second administrator. | The second user's panel remains visible until that user dismisses it. | **Passed** — second administrator retained an independent undismissed state |
| QS-08 | Submit the dismissal request with an invalid or missing nonce. | A recoverable branded error appears on the Forms screen; no user preference is written; forms/settings remain unchanged. | **Passed** — invalid nonce showed the recoverable error and left the panel visible |
| QS-09 | Attempt the dismissal request as a non-administrator. | The capability check rejects the request; no user preference is written. | **Passed** — subscriber request rejected with HTTP 403 |
| QS-10 | Use keyboard only: Tab through the panel, activate each link, and dismiss. | Focus order is logical, every control is reachable, and focus is visibly indicated. | **Passed** — Chrome keyboard run on 2026-08-30: Dismiss → Add New Form → Read Documentation → View Demo; all four controls were reachable and showed the intended orange outline/box-shadow. Public destinations opened; the demo endpoint currently redirects to the documentation page. |
| QS-11 | Inspect at desktop, approximately 768px, and 375px widths at 100% and 200% zoom. | Content remains readable in locally bundled Urbanist without clipped controls, unintended horizontal scrolling, or remote font requests. | **Passed** — isolated WordPress 7.1 browser harness using the exact merged markup/CSS at 1440, 768, 375 and 720 CSS px (desktop-at-200%-zoom equivalent). Page `scrollWidth` equaled `clientWidth` at every width; steps changed 4→2→1 columns; action containers had no overflow; Urbanist reported loaded from the local plugin stylesheet. |
| QS-12 | Run QS-01 through QS-11 with `WP_DEBUG` enabled and inspect the browser console. | No PHP warning/notice and no JavaScript console error is introduced. | **Passed with environment noise dispositioned** — no console warning/error originated from Quick Start markup, CSS or assets. Chrome-extension metadata errors, a WordPress Playground transition abort, and a WordPress 7.1/Twenty Twenty-Five inline-style notice were observed and are unrelated to FPSM; prior PHP 7.4/8.3 server logs remained clean. |
| QS-13 | Upgrade an existing FPSM installation containing saved forms to this branch. Open, edit, and submit an existing form. | Existing forms, options, shortcodes, hooks, and submission behavior continue unchanged; Quick Start remains absent. | **Passed** — existing rows/edit screen loaded with Quick Start absent; the existing form saved unchanged and produced a successful draft frontend submission |
| QS-14 | Revert the feature commits or reinstall the previous package on the disposable site. | The panel is removed without a database migration; existing forms and settings remain intact. | **Passed** — switching the same isolated site to `master` removed the asset and preserved both form rows |
| QS-15 | Deactivate and reactivate the plugin on the disposable site. | No onboarding redirect occurs and existing stored data remains intact. | **Passed** — reactivation returned to Plugins and preserved the administrator's dismissal preference |

## Release gate

Keep the pull request in draft until the required runtime rows above have recorded evidence and Regan explicitly approves merge and release. Do not merge, tag, version-bump, deploy, upload to CodeCanyon, or publish to WordPress.org from this checklist.

Runtime evidence in this document records assertions made against ephemeral WordPress Playground instances. Cookies and raw server responses are intentionally not committed. On 2026-08-30, browser screenshots, keyboard traversal, responsive/zoom measurements, local-font verification and console inspection completed QS-10–QS-12 against the exact UI artifacts merged at c4a56be2b85ce003a154fd51a6518b430a59d9a1. A short implementation recording is still required by the assignment definition of done; release remains a separate explicit approval gate.
