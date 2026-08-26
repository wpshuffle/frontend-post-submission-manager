# Quick Start onboarding smoke-test matrix

This checklist validates the FPSM Quick Start onboarding panel without changing existing forms, options, shortcodes, hooks, or template paths.

## Automated checks already run

| Check | Environment | Expected result | Recorded result |
| --- | --- | --- | --- |
| PHP syntax lint | PHP 7.4 | All PHP files parse without errors | Passed in GitHub Actions run 32926873523 |
| PHP syntax lint | PHP 8.3 | All PHP files parse without errors | Passed in GitHub Actions run 32926873523 |
| Scope/security review | Pull request diff | Capability, nonce, sanitization/escaping, translation, and user-meta isolation are present | Completed; runtime behavior still requires verification |

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
| QS-01 | Fresh install or clean test state; sign in as administrator; open **FPSM → Forms** with no forms. | One four-step Quick Start panel appears immediately below the FPSM page header. Steps read Create Form, Add Fields, Publish Shortcode, and Test Submission. | Not run |
| QS-02 | Create and save one form, then return to **FPSM → Forms**. | The standard forms list appears and Quick Start is absent. Existing rows and actions are unchanged. | Not run |
| QS-03 | Visit every other FPSM admin screen and unrelated WordPress admin screens. | Quick Start is absent; no layout regression occurs. | Not run |
| QS-04 | With no forms, activate **Add New Form** in the Quick Start panel. | The existing Add New Form route opens once; no activation redirect or extra remote request occurs. | Not run |
| QS-05 | Activate Documentation and Demo links. | Each opens the intended existing public destination. No private tracker or design URL is exposed. | Not run |
| QS-06 | As an administrator, dismiss the panel with a valid nonce, reload, sign out, and sign in again. | The panel remains hidden for that WordPress user and no form/settings data changes. | Not run |
| QS-07 | Repeat QS-01 using a second administrator. | The second user's panel remains visible until that user dismisses it. | Not run |
| QS-08 | Submit the dismissal request with an invalid or missing nonce. | A recoverable branded error appears on the Forms screen; no user preference is written; forms/settings remain unchanged. | Not run |
| QS-09 | Attempt the dismissal request as a non-administrator. | The capability check rejects the request; no user preference is written. | Not run |
| QS-10 | Use keyboard only: Tab through the panel, activate each link, and dismiss. | Focus order is logical, every control is reachable, and focus is visibly indicated. | Not run |
| QS-11 | Inspect at desktop, approximately 768px, and 375px widths at 100% and 200% zoom. | Content remains readable in locally bundled Urbanist without clipped controls, unintended horizontal scrolling, or remote font requests. | Not run |
| QS-12 | Run QS-01 through QS-11 with `WP_DEBUG` enabled and inspect the browser console. | No PHP warning/notice and no JavaScript console error is introduced. | Not run |
| QS-13 | Upgrade an existing FPSM installation containing saved forms to this branch. Open, edit, and submit an existing form. | Existing forms, options, shortcodes, hooks, and submission behavior continue unchanged; Quick Start remains absent. | Not run |
| QS-14 | Revert the feature commits or reinstall the previous package on the disposable site. | The panel is removed without a database migration; existing forms and settings remain intact. | Not run |
| QS-15 | Deactivate and reactivate the plugin on the disposable site. | No onboarding redirect occurs and existing stored data remains intact. | Not run |

## Release gate

Keep the pull request in draft until the required runtime rows above have recorded evidence and Regan explicitly approves merge and release. Do not merge, tag, version-bump, deploy, upload to CodeCanyon, or publish to WordPress.org from this checklist.
