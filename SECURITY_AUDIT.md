# Security Audit

Audit date: 2026-10-21

## Fixed

- Removed the public application-cache clearing endpoint.
- Protected cron and queue endpoints with `POST`, rate limiting, and `X-Cron-Secret` authentication.
- Added rate limits for web, mobile, and admin login, registration, password recovery, reset verification, and webhooks.
- Removed admin account enumeration and sensitive authentication diagnostics.
- Enforced eight-character minimum account passwords and one-time, email-bound, 15-minute reset codes.
- Added production-safe defaults for debug mode, log viewer, API documentation, secure cookies, CORS, and trusted hosts.
- Added security response headers and same-origin enforcement for legacy state-changing GET routes.
- Restored TLS certificate and host verification for all cURL integrations.
- Added signature/source validation and atomic, idempotent credits for PayVessel and Monnify webhooks.
- Added VPay payload-secret authentication and atomic, idempotent credits.
- Added server-side transaction verification and atomic credits for StroWallet and Paylony callbacks.
- Restricted merchant callback URLs to public HTTPS destinations, disabled redirects, and restored TLS verification to mitigate SSRF.
- Removed public SVG uploads from gift-card evidence, escaped raw provider output, and constrained attachment downloads to the verification directory.
- Replaced the committed application key with a blank environment template.

## Deployment Actions

1. Set every variable in the `Production Security` section of `README.md` before deployment.
2. Set `PAYVESSELSEK`, `MONNIFY_SECRET_KEY`, and `VPAY_PRIVATE_KEY` to the exact provider-side webhook secrets.
3. Update schedulers to send `POST` requests with `X-Cron-Secret`.
4. Keep API docs and the browser log viewer disabled except during controlled access.
5. Rotate any credential that has previously been committed, logged, emailed, or shared outside the password manager.
6. Verify PayVessel, Monnify, VPay, StroWallet, and Paylony callbacks in each provider sandbox before enabling live traffic.

## Remaining Upgrade Work

- Laravel 9 is end-of-life. Plan and test an upgrade to a currently supported Laravel/PHP release.
- The frontend lockfile audit reports 237 development dependency findings (65 low, 54 moderate, 78 high, 40 critical). The automated non-breaking lockfile update could not run because npm cache access was denied; update the build toolchain in a separate tested change.
- Composer advisory scanning could not run because PHP execution is blocked in this environment. Run `composer audit` in CI or the deployment environment.
- CoinRemitter uses a discontinued legacy API and its callback must be migrated to the current transaction-verification API before relying on crypto deposits.
- Some legacy balance-debit purchase flows are not transactionally locked. Add database transactions and row locks before high-concurrency production use.
- Merchant API keys are stored as reusable bearer tokens. Migrate to hashed, scoped, rotatable credentials with last-used/audit metadata.
- Legacy state-changing GET routes now reject cross-site requests, but should ultimately be converted to CSRF-protected `POST`, `PATCH`, or `DELETE` forms.

## Verification Commands

```bash
composer audit
php artisan test
php artisan route:list
npm audit
npm run production
```
