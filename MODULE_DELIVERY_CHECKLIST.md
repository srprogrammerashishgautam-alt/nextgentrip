# Module Delivery Checklist

Use this checklist before committing and pushing each phase or module.

## Scope Control

- The change implements only the active prompt/module.
- No unrelated cleanup, rewrites, or formatting churn.
- Existing user changes are preserved.
- Any missing third-party credential is handled with an interface, stub, or documented TODO.

## Backend

- Migrations are reversible.
- Tables use UUID primary keys where required.
- Soft deletes and audit columns are added where required.
- Services are covered by unit tests.
- API endpoints have feature tests for success, validation errors, auth failures, and permission failures.
- External APIs are wrapped behind adapters.
- Queue jobs are retry-safe and idempotent where needed.

## Frontend

- UI follows the existing design system once established.
- Loading, empty, error, and success states are present.
- Forms validate client-side and server-side.
- Large tables/calendars use efficient rendering.

## Security

- Secrets are not committed.
- Authorization policies are enforced.
- Tenant/hotel isolation is tested.
- Sensitive data is encrypted or masked as required.
- Audit logs capture important changes.

## Quality Gates

- Relevant tests pass.
- Lint/build checks pass where available.
- API contracts match the SOW.
- README or module docs are updated.
- Git diff is reviewed before commit.

## GitHub

- Commit message follows the requested prompt.
- Branch is pushed to `origin`.
- Pull request summary lists scope, tests, and any known limitations.
